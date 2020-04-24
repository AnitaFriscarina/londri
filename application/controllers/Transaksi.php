<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->library('pdf');
    }


    public function index()
    {
        $data['judul'] = 'Transaksi';
        $data['transaksi'] = $this->Model_transaksi->dataTransaksiHead();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidenav');
        $this->load->view('transaksi/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambahData()
    {
        if ($this->session->userdata('role') != 'admin' || $this->session->userdata('role') != 'kasir') {
            redirect('dashboard');
        }
        $data['outlet'] = $this->db->get('tb_outlet')->result_array();
        $data['member'] = $this->db->get('tb_member')->result_array();
        $data['paket'] = $this->db->get('tb_paket')->result_array();
        $data['judul'] = 'Tambah Data Transaksi';
        $this->form_validation->set_rules('id_outlet', 'Outlet', 'required');
        $this->form_validation->set_rules('id_member', 'Member', 'required');
        $this->form_validation->set_rules('tanggal_paket', 'Tanggal', 'required');
        $this->form_validation->set_rules('tanggal_batas', 'Tanggal', 'required');
        $this->form_validation->set_rules('qty[]', 'Quantity', 'required');
        $this->form_validation->set_rules('subtotal[]', 'Sub Total', 'required');
        $this->form_validation->set_rules('keterangan[]', 'Keterangan', 'trim');
        $this->form_validation->set_rules('paket[]', 'Pilihan Paket', 'required');



        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar');
            $this->load->view('templates/sidenav');
            $this->load->view('transaksi/tambahdata', $data);
            $this->load->view('templates/footer');
        } else {

            $outlet = $this->input->post('id_outlet');
            $member = $this->input->post('id_member');
            $tanggal = $this->input->post('tanggal_paket');
            $tanggalbatas = $this->input->post('tanggal_batas');
            $qty = $this->input->post('qty[]');
            $subtotal = $this->input->post('subtotal[]');
            $ket = $this->input->post('keterangan[]');
            $paket = $this->input->post('paket[]');
            $kodeinvoice = $this->Model_transaksi->invoiceUnik();
            $iduser = $this->session->userdata('id_user');
            $dataheader = [
                'id_outlet' => $outlet,
                'kode_invoice' => $kodeinvoice,
                'id_member' => $member,
                'pembeli_nonmember' => '',
                'tgl' => $tanggal,
                'batas_waktu' => $tanggalbatas,
                'tgl_bayar' => '',
                'biaya_tambahan' => '',
                'diskon' => '',
                'pajak' => '',
                'total_harga' => '',
                'status' => 'baru',
                'status_pembayaran' => 'belum dibayar',
                'id_user' => $iduser,
            ];
            $this->db->insert('tb_transaksi', $dataheader);
            $lastid = $this->db->insert_id();
            $datadetail = [];
            $i = 0;
            foreach ($paket as $p) {
                array_push($datadetail, [
                    'id_transaksi' => $lastid,
                    'id_paket' => $paket[$i],
                    'qty' => $qty[$i],
                    'subtotal' => $subtotal[$i],
                    'keterangan' => $ket[$i]
                ]);
                $i++;
            }
            $this->db->insert_batch('tb_transaksi_detail', $datadetail);

            $aksi = $this->session->userdata('username') . ' Menambahkan Transaksi ' . $kodeinvoice;
            activity_log('Insert', $aksi);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            Data Baru Telah Ditambahkan
             </div>');
            redirect('Transaksi/index');
        }
    }

    public function dataPaket()
    {
        $data = $this->Model_transaksi->ambilPaket()->result();
        echo json_encode($data);
    }

    public function hargaPaket()
    {
        $id = $this->input->post('id');

        $data = $this->Model_transaksi->ambilHarga($id)->result();
        echo json_encode($data);
    }


    public function ubahStatus()
    {

        $data['judul'] = 'Transaksi ';
        $data['transaksi'] = $this->Model_transaksi->dataTransaksiHead();
        $this->form_validation->set_rules('statuspekerjaan', 'Status', 'required');
        if ($this->form_validation->run() ==  false) {


            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar');
            $this->load->view('templates/sidenav');
            $this->load->view('transaksi/index', $data);
            $this->load->view('templates/footer');
        } else {
            $id = $this->input->post('idtransheader');
            $status = $this->input->post('statuspekerjaan');


            $this->db->set('status', $status);
            $this->db->where('id', $id);
            $this->db->update('tb_transaksi');

            $aksi = $this->session->userdata('username') . ' Mengubah Status Transaksi ' . $id . ' Menjadi ' . $status;
            activity_log('Update', $aksi);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            Status Berhasil Dirubah
             </div>');
            redirect('Transaksi/index');
        }
    }
    public function bayar()
    {

        $data['judul'] = 'Transaksi ';
        $data['transaksi'] = $this->Model_transaksi->dataTransaksiHead();
        $this->form_validation->set_rules('takhir', 'Total Akhir', 'required');
        $this->form_validation->set_rules('tanggalbayar', 'Tanggal Bayar', 'required');

        if ($this->form_validation->run() ==  false) {


            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar');
            $this->load->view('templates/sidenav');
            $this->load->view('transaksi/index', $data);
            $this->load->view('templates/footer');
        } else {
            $id = $this->input->post('idheader');
            $takhir = $this->input->post('takhir');
            $pajak = $this->input->post('pajak');
            $bt = $this->input->post('biayatambahan');
            $diskon = $this->input->post('diskon');
            $tglbayar = $this->input->post('tanggalbayar');

            $data = [
                'status_pembayaran' => 'dibayar',
                'pajak' => $pajak,
                'diskon' => $diskon,
                'biaya_tambahan' => $bt,
                'total_harga' => $takhir,
                'tgl_bayar' => $tglbayar
            ];



            $this->db->set($data);
            $this->db->where('id', $id);
            $is = $this->db->update('tb_transaksi');

            $aksi = $this->session->userdata('username') . ' Melakukan Pembayaran Transaksi ' . $id;
            activity_log('Update', $aksi);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            Pembayaran Behasil
             </div>');
            redirect('Transaksi/index');
        }
    }


    public function delete()
    {
        $id =  $this->input->post('idtransaksi');
        $this->Model_transaksi->hapusDetail($id);
        $this->Model_transaksi->hapusHeader($id);

        $aksi = $this->session->userdata('username') . ' Menghapus Transaksi ' . $id;
        activity_log('Delete', $aksi);
        $this->session->set_flashdata('pesan', '<div class="alert alert-warning" role="alert">
        Data Berhasil Di Hapus
         </div>');
        redirect('Transaksi/index');
    }

    public function detail()
    {
        //ngambil url parameternya
        $id = $this->uri->segment(3);
        if ($id != null) {
            $data['header'] = $this->Model_transaksi->detailTransaksiHead($id);
            $data['detail'] = $this->Model_transaksi->detailTransaksiDet($id);
            $data['judul'] = 'Detail Transaksi';
            $data['id'] = $id;
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar');
            $this->load->view('templates/sidenav');
            $this->load->view('transaksi/detail', $data);
            $this->load->view('templates/footer');
        } else {
            redirect('Dashboard');
        }
    }




    public function pdf($id)
    {

        $datahed = $this->Model_transaksi->detailTransaksiHead($id);
        $datadet = $this->Model_transaksi->detailTransaksiDet($id);
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        $pdf->setPrintFooter(false);
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
        $pdf->setPrintHeader(true);

        $pdf->AddPage('');

        $pdf->SetFont('');
        $pdf->SetTitle('Nota Laundy');
        $pdf->SetSubject('Nota Laundry');

        $header = '';
        foreach ($datahed as $dh) {

            $header .= '<h1 style="text-align:center">' . $dh['nama'] . ' </h1><br>';
            $header .= '<p style="text-align:center">' . $dh['alamat'] . ' <p>';
            $header .= '<h3 style="text-align:center">' . $dh['kode_invoice'] . '</h3><br><hr>';
        }
        $pdf->writeHTML($header);
        $info = '';
        foreach ($datahed as $dh) {

            $info .= 'Nama Pelanggan : <b>' . $dh['namamember'] . '</b>';
            $info .= '<p> Status Pembayaran : <b>' . $dh['status_pembayaran'] . '</b></p>';
            $info .= '<p> Tanggal Laundry : <b>' . $dh['tgl'] . '</b></p>';
            $info .= '<p> Tanggal Bayar : <b>' . $dh['tgl_bayar'] . '</b></p>';
            $info .= '<p> Pajak : <b>' . $dh['pajak'] . '%</b></p>';
            $info .= '<p> Diskon : <b>' . $dh['diskon'] . '%</b></p>';
            $info .= '<p> Biaya Tambahan : <b> Rp. ' . number_format($dh['biaya_tambahan'], 0, ',', '.') . '</b></p>';
            $info .= '<p> Total Harga : <b> Rp. ' . number_format($dh['total_harga'], 0, ',', '.') . '</b></p> <br>';
        }
        $pdf->writeHTML($info);



        $no = 1;
        $tabel = '
        <table border="1">
              <tr>
                    <th style="text-align:center"> <b>No</b> </th>
                    <th style="text-align:center"> <b>Nama Paket</b> </th>
                    <th style="text-align:center"> <b>Quantity</b> </th>
                    <th style="text-align:center"> <b>Subtotal</b> </th>
              </tr>';
        foreach ($datadet as $det) {
            $tabel .= '<tr><td style="text-align:center">' . $no . '</td><td style="text-align:center">' . $det['nama_paket'] . '</td ><td style="text-align:center">' . $det['qty'] . '</td><td style="text-align:center">' . 'Rp ' . number_format($det['subtotal'], 0, ',', '.') . '</td></tr>';
            $no++;
        }





        $tabel .= '</table>';
        $pdf->writeHTML($tabel);

        $footer = '<br><br><br>';
        $footer .= '<p style="text-align: left">Serah Terima</p><br><br><br>';
        $pdf->writeHTML($footer);


        $footers = '<br>';
        $footers .= '<br><br><br><p>' . $dh['nama'] . '</p>';
        $pdf->writeHTML($footers);


        $pdf->Output('file-pdf-codeigniter.pdf', 'I');
    }
}
