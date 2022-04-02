<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Model_pemesanan;
use App\Models\model_kamar;
use App\Models\Model_dashboard;

class Pemesanan extends BaseController
{

    protected $Model_pemesanan;
    public function __construct()
    {
        $this->Model_pemesanan = new Model_pemesanan();
        helper('form');
        $this->db = db_connect();
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $session = session();
        if (!$session->get('username_login') || $session->get('status_login') == 'customer') {
            return redirect()->to('Login/indexAdmin');
        }

        $model_dash = new Model_dashboard();
        $jumlah_pemesanan = $model_dash->jumlah_pemesanan()->getRowArray();

        $model = new Model_pemesanan();
        $pemesanan = $model->view_data()->getResultArray();
        $data = [
            'judul' => 'Pemesanan',
            'page_header' => 'Pemesanan',
            'panel_title' => 'Tabel Pemesanan',
            'pemesanan' => $pemesanan,
            'jumlah_pemesanan' => $jumlah_pemesanan['id_pemesanan']
        ];
        return view('admin/vTPemesanan', $data);
    }

    public function add_pemesanan()
    {
        $session = session();
        helper(['form', 'url']);

        $data = array(
            'id_pengguna'     => $this->request->getPost('input_pengguna'),
            'bukti_transaksi'     => $this->request->getPost('input_pengguna'),
            'tanggal_pesan'     => $this->request->getPost('input_tanggal'),
            'status_pemesanan'     => $this->request->getPost('input_status')
        );
        $model = new Model_pemesanan();
        $model->add_data($data);
        $session->setFlashdata('sukses', 'Data sudah berhasil ditambah');
        return redirect()->to(base_url('Admin/Pemesanan'));
    }

    public function update_pemesanan()
    {
        $session = session();
        helper(['form', 'url']);
        $model = new Model_pemesanan();
        
        $id = $this->request->getPost('id_pemesanan');
        $data = array(
            'id_pengguna'     => $this->request->getPost('edit_pengguna'),
            'bukti_transaksi'     => $this->request->getPost('edit_pengguna'),
            'tanggal_pesan'     => $this->request->getPost('edit_tanggal'),
            'status_pemesanan'     => $this->request->getPost('edit_status')
        );

        $model->update_data($data, $id);
        $session->setFlashdata('sukses', 'Data sudah berhasil diubah');
        return redirect()->to(base_url('Admin/Pemesanan'));
    }

    public function delete_pemesanan()
    {
        $model = new Model_pemesanan();
        $id = $this->request->getPost('id');
        $session = session();
        $model->delete_data($id);

        session()->setFlashdata('sukses', 'Data sudah berhasil dihapus');
        return redirect()->to('/Admin/Pemesanan');
    }

    public function data_pengguna()
    {
        $request = service('request');
        $postData = $request->getPost(); // OR $this->request->getPost();

        $response = array();

        $data = array();

        $db      = \Config\Database::connect();
        $builder = $this->db->table("pengunjung");

        $poli = [];

        if (isset($postData['query'])) {

            $query = $postData['query'];

            // Fetch record
            $builder->select('id_pengguna, nama_lengkap');
            $builder->like('nama_lengkap', $query, 'both');
            $query = $builder->get();
            $data = $query->getResult();
        } else {

            // Fetch record
            $builder->select('id_pengguna, nama_lengkap');
            $query = $builder->get();
            $data = $query->getResult();
        }

        foreach ($data as $pengguna) {
            $poli[] = array(
                "id" => $pengguna->id_pengguna,
                "text" => $pengguna->nama_lengkap,
            );
        }

        $response['data'] = $poli;

        return $this->response->setJSON($response);
    }

    public function data_edit($id_pemesanan)
    {
        $model = new Model_pemesanan();
        $datapemesanan = $model->detail_data($id_pemesanan)->getResultArray();
        $respon = json_decode(json_encode($datapemesanan), true);
        $data['results'] = array();
        foreach ($respon as $value) :
            $isi['id_pemesanan'] = $value['id_pemesanan'];
            $isi['id_pengguna'] = $value['id_pengguna'];
            $isi['nama_lengkap'] = $value['nama_lengkap'];
            $isi['tanggal_pesan'] = $value['tanggal_pesan'];
            $isi['status_pemesanan'] = $value['status_pemesanan'];
            $isi['bukti_transaksi'] = $value['bukti_transaksi'];
        endforeach;
        echo json_encode($isi);
    }
}
