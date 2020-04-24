<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_transaksi extends CI_Model
{
    public function ambilPaket()
    {

        return $this->db->get('tb_paket');
    }

    public function ambilHarga($id)
    {
        return $this->db->get_where('tb_paket', ['id' => $id]);
    }

    public function dataTransaksiHead()
    {
        $query = "SELECT tb_transaksi.id, tb_transaksi.kode_invoice, tb_transaksi.id_member, tb_transaksi.pembeli_nonmember, tb_transaksi.tgl, tb_transaksi.total_harga, tb_transaksi.status, tb_transaksi.status_pembayaran, tb_member.nama FROM tb_transaksi JOIN tb_outlet ON tb_transaksi.id_outlet = tb_outlet.id JOIN tb_member ON tb_transaksi.id_member = tb_member.id";
        return $this->db->query($query)->result_array();
    }


    public function invoiceUnik()
    {
        $query = "SELECT MAX(id) as Max FROM tb_transaksi";
        $lastid =  $this->db->query($query);
        $inv = "Invoice - ";
        if ($lastid->num_rows() > 0) {

            foreach ($lastid->result_array() as $li) {
                $angka = intval($li['Max']) + 1;
            }
        } else {
            $angka = 1;
        }
        return $inv .=  $angka;
    }


    public function hapusHeader($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tb_transaksi');
    }

    public function hapusDetail($id)
    {
        $this->db->where('id_transaksi', $id);
        $this->db->delete('tb_transaksi_detail');
    }


    public function detailTransaksiHead($id)
    {
        $query = "SELECT tb_transaksi.id, tb_transaksi.id_outlet, tb_outlet.alamat, tb_transaksi.kode_invoice, tb_transaksi.id_member, tb_transaksi.pembeli_nonmember, tb_transaksi.pajak, tb_transaksi.diskon, tb_transaksi.total_harga, tb_transaksi.biaya_tambahan, tb_transaksi.tgl, tb_transaksi.total_harga, tb_transaksi.status, tb_transaksi.status_pembayaran, tb_member.nama as namamember, tb_outlet.nama, tb_transaksi.batas_waktu, tb_transaksi.tgl_bayar   FROM tb_transaksi JOIN tb_outlet ON tb_transaksi.id_outlet = tb_outlet.id JOIN tb_member ON tb_transaksi.id_member = tb_member.id WHERE tb_transaksi.id = $id";
        return $this->db->query($query)->result_array();
    }

    public function detailTransaksiDet($id)
    {
        $query = "SELECT tb_transaksi_detail.qty, tb_transaksi_detail.subtotal, tb_transaksi_detail.keterangan, tb_paket.nama_paket, tb_paket.harga FROM tb_transaksi_detail JOIN tb_paket ON tb_transaksi_detail.id_paket = tb_paket.id WHERE tb_transaksi_detail.id_transaksi = $id";
        return $this->db->query($query)->result_array();
    }
}
