<?php

namespace App\Controllers\SuperAdmin;

use App\Controllers\BaseController;
use App\Models\Model_kamar;
use App\Models\Model_foto_kamar;
use App\Models\Model_dashboard;

class Kamar extends BaseController
{

    protected $Model_kamar;
    public function __construct()
    {
        $this->Model_kamar = new Model_kamar();
        helper(['form', 'url']);
        $this->db = db_connect();
    }

    public function index()
    {
        $session = session();
        if (!$session->get('username_login') || $session->get('status_login') != 'superadmin') {
            return redirect()->to('Login/indexAdmin');
        }

        $model_dash = new Model_dashboard();
        $jumlah_pemesanan = $model_dash->jumlah_pemesanan()->getRowArray();

        $model = new Model_kamar();
        $kamar = $model->view_data()->getResultArray();
        $data = [
            'judul' => 'Kamar',
            'page_header' => 'Kamar',
            'panel_title' => 'Tabel Kamar',
            'kamar' => $kamar,
            'jumlah_pemesanan' => $jumlah_pemesanan['id_pemesanan']
        ];
        return view('superadmin/vTKamar', $data);
    }

    public function add_kamar()
    {
        $session = session();
        $data = array(
            'nama_kamar'     => $this->request->getPost('input_nama'),
            'status_kamar'     => $this->request->getPost('input_status'),
            'biaya'     => $this->request->getPost('input_biaya'),
            'id_kategori'     => $this->request->getPost('input_kategori')
        );
        $model = new Model_kamar();
        $model->add_data($data);
        $session->setFlashdata('sukses', 'Data sudah berhasil ditambah');
        return redirect()->to(base_url('SuperAdmin/Kamar'));
    }

    public function update_kamar()
    {
        $session = session();
        $model = new Model_kamar();
        
        $id = $this->request->getPost('id_kamar');
        $data = array(
            'nama_kamar'     => $this->request->getPost('edit_nama'),
            'id_kategori'     => $this->request->getPost('edit_kategori'),
            'biaya'     => $this->request->getPost('edit_biaya'),
            'status_kamar'     => $this->request->getPost('edit_status')
        );

        $model->update_data($data, $id);
        $session->setFlashdata('sukses', 'Data sudah berhasil diubah');
        return redirect()->to(base_url('SuperAdmin/Kamar'));
    }

    public function delete_kamar()
    {
        $model = new Model_kamar();
        $id = $this->request->getPost('id');
        $session = session();
        $foreign = $model->cek_foreign($id);
        if ($foreign == 0) {
            $model->delete_data($id);
            session()->setFlashdata('sukses', 'Data sudah berhasil dihapus');
        } else {
            session()->setFlashdata('sukses', 'Data ini dipakai di tabel lain dan tidak bisa dihapus');
        }
        return redirect()->to('/SuperAdmin/Kamar');
    }

    public function data_kategori()
    {
        $request = service('request');
        $postData = $request->getPost(); // OR $this->request->getPost();

        $response = array();

        $data = array();

        $db      = \Config\Database::connect();
        $builder = $this->db->table("kategori_kamar");

        $poli = [];

        if (isset($postData['query'])) {

            $query = $postData['query'];

            // Fetch record
            $builder->select('id_kategori, nama_kategori');
            $builder->like('nama_kategori', $query, 'both');
            $query = $builder->get();
            $data = $query->getResult();
        } else {

            // Fetch record
            $builder->select('id_kategori, nama_kategori');
            $query = $builder->get();
            $data = $query->getResult();
        }

        foreach ($data as $pengguna) {
            $poli[] = array(
                "id" => $pengguna->id_kategori,
                "text" => $pengguna->nama_kategori,
            );
        }

        $response['data'] = $poli;

        return $this->response->setJSON($response);
    }

    public function cek_nama($nama)
    {
        $model = new Model_kamar();
        $cek_nama = $model->cek_nama($nama)->getResultArray();
        $respon = json_decode(json_encode($cek_nama), true);
        $data['results'] = count($respon);
        echo json_encode($data);
    }

    public function data_edit($id_kamar)
    {
        $model = new Model_kamar();
        $datakamar = $model->detail_data($id_kamar)->getResultArray();
        $respon = json_decode(json_encode($datakamar), true);
        $data['results'] = array();
        foreach ($respon as $value) :
            $isi['id_kamar'] = $value['id_kamar'];
            $isi['nama_kamar'] = $value['nama_kamar'];
            $isi['status_kamar'] = $value['status_kamar'];
            $isi['id_kategori'] = $value['id_kategori'];
            $isi['nama_kategori'] = $value['nama_kategori'];
            $isi['biaya'] = $value['biaya'];
        endforeach;
        echo json_encode($isi);
    }

    public function view_foto($id)
    {
        $model_dash = new Model_dashboard();
        $jumlah_pemesanan = $model_dash->jumlah_pemesanan()->getRowArray();

        $model = new Model_foto_kamar();
        $foto_kamar = $model->view_data($id)->getResultArray();
        $nama_kamar = $model->view_data($id)->getRowArray();
        $data = [
            'judul' => 'Foto Kamar',
            'page_header' => 'Foto Kamar',
            'panel_title' => 'Tabel Foto Kamar',
            'foto_kamar' => $foto_kamar,
            'jumlah_pemesanan' => $jumlah_pemesanan['id_pemesanan'],
            'id_foto' => $id,
            'id' => $id
        ];
        return view('admin/vTFotoKamar', $data);
    }

    public function add_foto_kamar()
    {
        $session = session();
        // if (!$session->get('username_login') || $session->get('level_login') == 'User') {
        //     return redirect()->to('/booking_hotel/Admin/Login');
        // }

        $id_kamar = $this->request->getPost('input_id');
        if($imagefile = $this->request->getFiles())
        {
            
           foreach($imagefile['input_file'] as $img)
           {
              if ($img->isValid() && ! $img->hasMoved())
              {
                    $namabaru     = $img->getRandomName();
                    $img->move('docs/img/img_kamar/', $namabaru);
                    $data = array(
                        'id_kamar'     => $id_kamar,
                        'nama_foto'      => "docs/img/img_kamar/" . $namabaru
                    );
                    $model = new Model_foto_kamar();
                    $model->add_data($data);
              }
           }
        }
        
        $session->setFlashdata('sukses', 'Data sudah berhasil ditambah');
        return redirect()->to('/SuperAdmin/Kamar/view_foto/' . $id_kamar);
    }

    public function data_edit_foto($id_foto)
    {
        $session = session();
        $model = new Model_foto_kamar();
        $data_foto = $model->detail_data($id_foto)->getResultArray();
        $respon = json_decode(json_encode($data_foto), true);
        $data['results'] = array();
        foreach ($respon as $value) :
            $isi['id_foto'] = $value['id_foto'];
            $isi['nama_foto'] = $value['nama_foto'];
            $isi['id_kamar'] = $value['id_kamar'];
        endforeach;
        echo json_encode($isi);
    }

    public function update_foto_kamar()
    {
        $session = session();
        $model = new Model_foto_kamar();

        $file = $this->request->getFile('edit_file');
        $id = $this->request->getPost('id_foto');
        $id_kamar = $this->request->getPost('id_kamar');

        $avatar      = $this->request->getFile('edit_file');
        $namabaru     = $avatar->getRandomName();
        $avatar->move('docs/img/img_kamar/', $namabaru);
        $data = array(
            'id_kamar'   => $id_kamar,
            'nama_foto' => "docs/img/img_kamar/" . $namabaru
        );

        $data_foto = $model->detail_data($id)->getRowArray();
        if ($data_foto != null) {
            if ($data_foto['nama_foto'] != 'docs/img/img_kamar/noimage.jpg') {
                if (file_exists($data_foto['nama_foto'])) {
                    unlink($data_foto['nama_foto']);
                }
            }
        }

        $model->update_data($data, $id);
        $session->setFlashdata('sukses', 'Data sudah berhasil di Ubah');

        return redirect()->to('/SuperAdmin/Kamar/view_foto/' . $id_kamar);
    }

    public function delete_foto_kamar()
    {
        $session = session();
        $model = new Model_foto_kamar();
        $id = $this->request->getPost('id');
        $id_kamar = $this->request->getPost('id_kamar');
        $model->delete_data($id);
        $data_foto = $model->detail_data($id)->getRowArray();

        if ($data_foto != null) {
            if ($data_foto['nama_foto'] != 'docs/img/img_kamar/noimage.jpg') {
                if (file_exists($data_foto['nama_foto'])) {
                    unlink($data_foto['nama_foto']);
                }
            }
        }
        
        return redirect()->to('/SuperAdmin/Kamar/view_foto/' . $id_kamar);
    }
}
