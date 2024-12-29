# SIDUMASO LILIS PROJECT

koie lis carane ngopy neng project ben ora bola bali donload

- buka terminal sekarepan ng ndi
- git clone http://github.com/RiqqiAmru/sidumaso-lilis
- composer update
- (database raussah asle smn wes duwe)
- php spark serve

* enum jenis pengaduan
  infrastruktur
  sengketa lahan
  keamanan dan ketertiban
  lingkungan
  pengelolaan dana desa
  Lainnya

  intine biso tambah,
  biso edit nek pengaduane drg di proses,
  biso dihapus nek pengaduane drg diproses,
  biso nambah tanggapan nek pengaduane ws diproses,
  biso mencet selesai nek pengaduane ws diproses

status aduan
menunggu , proses , selesai

TABEL ADUAN = id, jenis_aduan, status_aduan(privat/publik), rincian, id_pengadu, id_admin, ket

0- menunggu
1- proses
2- kurang data
3 selesai
4 invalid

TABEL FOTO_ADUAN =id, id_aduan, foto

tabel tanggapan = id, jenis_tanggapan, rincian_admin, rincian_pengadu, ket

TABEL FOTO_TANGGAPAN = id, id_tanggapan, foto, ket(admin/pengirim)

error

-

# SIDUMASO LILIS PROJECT

-blum ada fitur :

1. lupa password ,
2. back up data ,
3. tidak ada fitur nambah jenis pengaduan

4. filtering desc di pengaduan proses , (WES DESC)
5. edit pengaduan, [validasi gambar susah]
6. file bukti pengaduan diganti opsional (SUDAH OPSIONAL)

7. keterangan di laporan tgl brp (ketika cetak laporan ada keterangan berdasarkan filter opo)✅
8. kepala dusun tampilan sidebar tidak ada pengumuman kr daftar pengguna✅
9. filtering laporan (nek difilter metu tanggapane tapi nek ora dipilih periode/tanpa filter tapi klik tombol filter, tanggapane rak kepanggil) kurang per jenis pengaduan juga✅
10. ganti view pengumuman masyarakat✅
11. ganti nama field database ✅
12. ubah password,✅
13. notif ubah password✅
14. hapus created_at di pengumuman✅(dicek dulu nanti)
15. modal untuk foto tanggapan✅
16. harusnya tombol komentar jika status proses saja ,✅
