<?php

namespace App\Controllers\Admin;

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
    }

    public function index()
    {
        $session = session();
        if (!$session->get('username_login') || $session->get('status_login') == 'customer') {
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
            'jumlah_pemesanan' => $jumlah_pemesanan['id']
        ];
        return view('admin/vTKamar', $data);
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
        return redirect()->to(base_url('Admin/Kamar'));
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
            'status_kamar'     => $this->request->getPost('edit_status'),
            'id'     => $this->request->getPost('id_kamar')
        );

        $model->update_data($data, $id);
        $session->setFlashdata('sukses', 'Data sudah berhasil diubah');
        return redirect()->to(base_url('Admin/Kamar'));
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
        return redirect()->to('/Admin/Kamar');
    }

    public function data_kategori()
    {
        $model = new Model_kamar();
        $data_kategori = $model->data_kategori()->getResultArray();
        $respon = json_decode(json_encode($data_kategori), true);
        $data['results'] = array();

        foreach ($respon as $value) {
            $isi['id'] = $value['id'];
            $isi['text'] = $value['nama_kategori'];
            array_push($data['results'], $isi);
        }
        echo json_encode($data);
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
            $isi['id'] = $value['id'];
            $isi['nama_kamar'] = $value['nama_kamar'];
            $isi['status_kamar'] = $value['status_kamar'];
            $isi['id_kategori'] = $value['id_kategori'];
            $isi['nama_kategori'] = $value['nama_kategori'];
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
            'page_header' => 'Foto Kamar ' . $nama_kamar['nama_kamar'],
            'panel_title' => 'Tabel Foto Kamar',
            'foto_kamar' => $foto_kamar,
            'jumlah_pemesanan' => $jumlah_pemesanan['id'],
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
        return redirect()->to('/Admin/Kamar/view_foto/' . $id_kamar);
    }

    public function data_edit_foto($id_foto)
    {
        $session = session();
        $model = new Model_foto_kamar();
        $data_foto = $model->detail_data($id_foto)->getResultArray();
        $respon = json_decode(json_encode($data_foto), true);
        $data['results'] = array();
        foreach ($respon as $value) :
            $isi['id'] = $value['id'];
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

        return redirect()->to('/Admin/Kamar/view_foto/' . $id_kamar);
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
        
        return redirect()->to('/Admin/Kamar/view_foto/' . $id_kamar);
    }
}