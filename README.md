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

4. hapus field foto pada laporan✅
5. menambah filtering per perihal (jenis pengaduan : infrastukrur dll)✅
6. tampilan di daftar pengaduan gambar hanya keluar 1✅ sudah diganti
7. bukti pengaduan bisa pdf/doc✅
8. bukti pada edit pengaduan ✅
9. menambah pilihan (—pilih jenis tanggapan—)✅
10. landing page diberi informasi total pengaduan yang sedang diproses✅
11. keterangan di laporan tgl brp (ketika cetak laporan ada keterangan berdasarkan filter opo)✅
12. kepala dusun tampilan sidebar tidak ada pengumuman kr daftar pengguna✅
13. filtering laporan (nek difilter metu tanggapane tapi nek ora dipilih periode/tanpa filter tapi klik tombol filter, tanggapane rak kepanggil) kurang per jenis pengaduan juga✅
14. ganti view pengumuman masyarakat✅
15. ganti nama field database ✅
16. ubah password,✅
17. notif ubah password✅
18. hapus created_at di pengumuman✅(dicek dulu nanti)
19. modal untuk foto tanggapan✅
20. harusnya tombol komentar jika status proses saja ,✅
