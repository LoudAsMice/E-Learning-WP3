<?php

namespace App\Models;
use CodeIgniter\Model;

class ModelKuliah extends Model
{
    public function getMateri($where = null)
    {
        return $this->db->table('materi')->getWhere($where);
    }

    public function getKelasDistinct($where = null)
    {
        return $this->db->table('matakuliah')->select('kelas')->distinct()->getWhere($where);
    }

    public function getMatkulDistinct($where = null)
    {
        return $this->db->table('matakuliah')->select('matakuliah')->distinct()->getWhere($where);
    }

    public function getTugas($where = null)
    {
        return $this->db->table('tugas')->getWhere($where);
    }

    public function getAbsensi($where)
    {
        return $this->db->table('absen')->select('absen.id, absen.kelas, mahasiswa.nim, mahasiswa.nama, mahasiswa.kelas, matakuliah.matakuliah, absen.pertemuan, absen.tanggal, absen.status_absen, absen.status, absen.berita')->join('mahasiswa', 'absen.nim = mahasiswa.nim')->join('matakuliah', 'absen.matkul = matakuliah.id')->getWhere($where);
    }

    public function hapusMateri($where = null)
    {
        return $this->db->table('materi')->delete($where);
    }

    public function hapusTugas($where = null)
    {
        return $this->db->table('tugas')->delete($where);
    }

    public function hapusMatakuliah($where = null)
    {
        return $this->db->table('matakuliah')->delete($where);
    }

    public function joinMateri($where)
    {
        return $this->db->table('dosen')->select('*')->join('materi', 'materi.nip = dosen.nip')->where($where)->get();
    }

    public function joinTugas($where)
    {
        return $this->db->table('dosen')->select('*')->join('tugas', 'tugas.nip = dosen.nip')->where($where)->orderBy('tanggal', 'desc')->get();
    }

    public function joinNilai($where)
    {
        return $this->db->table('nilai')->select('*')->join('mahasiswa', 'nilai.nim = mahasiswa.nim')->where($where)->get();
    }
}