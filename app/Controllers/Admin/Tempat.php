<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Model_tempat;
use App\Models\Model_dashboard;

class Tempat extends BaseController
{

    protected $Model_tempat;
    public function __construct()
    {
        $this->Model_tempat = new Model_tempat();
        helper('form');
    }

    public function index()
    {
        $session = session();
        if (!$session->get('username_login') || $session->get('status_login') == 'customer') {
            return redirect()->to('Login/indexAdmin');
        }

        $model_dash = new Model_dashboard();
        $jumlah_pemesanan = $model_dash->jumlah_pemesanan()->getRowArray();

        $model = new Model_tempat();
        $tempat = $model->view_data()->getResultArray();
        $data = [
            'judul' => 'Tempat',
            'page_header' => 'Tempat',
            'panel_title' => 'Tabel Tempat',
            'tempat' => $tempat,
            'jumlah_pemesanan' => $jumlah_pemesanan['id_pemesanan']
        ];
        return view('admin/vTTempat', $data);
    }

    public function add_tempat()
    {
        $session = session();
        helper(['form', 'url']);
        $avatar      = $this->request->getFile('input_foto');
        if($avatar != '') {
            $namabaru     = $avatar->getRandomName();
            $avatar->move('docs/img/img_tempat/', $namabaru);
        } else {
            $namabaru = 'n';
        }

        $data = array(
            'nama_tempat'     => $this->request->getPost('input_nama'),
            'url_tempat'     => $this->request->getPost('input_url'),
            'alamat_tempat'     => $this->request->getPost('input_alamat'),
            'deskripsi'     => $this->request->getPost('input_deskripsi'),
            'jarak_tempat'     => $this->request->getPost('input_jarak'),
            'latitude'     => $this->request->getPost('input_lat'),
            'longitude'     => $this->request->getPost('input_long'),
            'foto' => $namabaru
        );
        $model = new Model_tempat();
        $model->add_data($data);
        $session->setFlashdata('sukses', 'Data sudah berhasil ditambah');
        return redirect()->to(base_url('Admin/Tempat'));
    }

    public function update_tempat()
    {
        $session = session();
        helper(['form', 'url']);
        $model = new Model_tempat();

        $avatar      = $this->request->getFile('edit_foto');
        $foto_lama      = $this->request->getPost('foto_edit_lama');
        if($avatar == '') {
            $data = array(
                'nama_tempat'     => $this->request->getPost('edit_nama'),
                'url_tempat'     => $this->request->getPost('edit_url'),
                'alamat_tempat'     => $this->request->getPost('edit_alamat'),
                'deskripsi'     => $this->request->getPost('edit_deskripsi'),
                'jarak_tempat'     => $this->request->getPost('edit_jarak'),
                'latitude'     => $this->request->getPost('edit_lat'),
                'longitude'     => $this->request->getPost('edit_long')
            );
        } else {
            if($foto_lama != null && $foto_lama != 'n') {
                if (file_exists('docs/img/img_tempat/' . $foto_lama)) {
                    unlink('docs/img/img_tempat/' . $foto_lama);
                }
            }
            
            $namabaru     = $avatar->getRandomName();
            $avatar->move('docs/img/img_tempat/', $namabaru);
            $data = array(
                'nama_tempat'     => $this->request->getPost('edit_nama'),
                'url_tempat'     => $this->request->getPost('edit_url'),
                'alamat_tempat'     => $this->request->getPost('edit_alamat'),
                'deskripsi'     => $this->request->getPost('edit_deskripsi'),
                'jarak_tempat'     => $this->request->getPost('edit_jarak'),
                'latitude'     => $this->request->getPost('edit_lat'),
                'longitude'     => $this->request->getPost('edit_long'),
                'foto' => $namabaru
            ); 
        }
        
        $id = $this->request->getPost('id_tempat');

        $model->update_data($data, $id);
        $session->setFlashdata('sukses', 'Data sudah berhasil diubah');
        return redirect()->to(base_url('Admin/Tempat'));
    }

    public function delete_tempat()
    {
        $model = new Model_tempat();
        $id = $this->request->getPost('id');
        $wisata = $model->detail_data($id)->getRowArray();
        dd($wisata['foto']);
        if($wisata['foto'] != 'n') {
            if (file_exists('docs/img/img_tempat/' . $wisata['foto'])) {
                unlink('docs/img/img_tempat/' . $wisata['foto']);
            }
        }
        $session = session();
        $model->delete_data($id);
        session()->setFlashdata('sukses', 'Data sudah berhasil dihapus');
        return redirect()->to('/Admin/Tempat');
    }

    public function data_edit($id_tempat)
    {
        $model = new Model_tempat();
        $datawisata = $model->detail_data($id_tempat)->getResultArray();
        $respon = json_decode(json_encode($datawisata), true);
        $data['results'] = array();
        foreach ($respon as $value) :
            $isi['id_tempat'] = $value['id_tempat'];
            $isi['nama_tempat'] = $value['nama_tempat'];
            $isi['url_tempat'] = $value['url_tempat'];
            $isi['alamat_tempat'] = $value['alamat_tempat'];
            $isi['deskripsi'] = $value['deskripsi'];
            $isi['jarak_tempat'] = $value['jarak_tempat'];
            $isi['latitude'] = $value['latitude'];
            $isi['longitude'] = $value['longitude'];
            $isi['foto'] = $value['foto'];
        endforeach;
        echo json_encode($isi);
    }
}
