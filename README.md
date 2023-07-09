RULE
1. 1 kelas dalam sehari max 3 matkul
2. dosen mengajar minim 2x perhari dan max4
3. ruangan 4 praktikum di ruangan praktikum dan teori masuk teori
4. login page diubah

###########################################################################

Mas penjadwalan ini untuk semester genap ya (2,4,6) semester 8 enggak di jadwal soalnya cuma skripsi sama kkn. 

Penjadwalan ini 1 kelas max 3 matkul, Dosen mengajar min 2 max 3. => masuk ke dalam validasi pembuatan dosen pengampu

Hari jumat pagi pengajian ( jadi jam pertama tidak boleh diisi matkul)

Kelas nya kan ada 3 (a,b,c) yang C itu kelas karyawan, 
Tapi kan dataku ini data semester genap tahun 2022. Itu kelas karyawan tidak dimasukkan.

#################### DONE ##############################

====================== V1 ================================
Penambahan authentikasi
pembenahan route name semua fitur
pembenahan crud fitur dosen
pembuatan crud fitur matkul
pembuatan crud fitur ruang
pembuatan crud fitur kelas
pembuatan crud fitur pengampu
pembuatan crud fitur jam
pembenahan crud fitur hari
====================== NOTE ==============================
1. penambahan halaman login dan register (username & password) (done)
2. data" di halaman dashboard belum sesuai dg database (isinya dibuat seperti apa??)
3. menu dosen CRUD bermasalah,  (done)
bagian edit data dosen untuk NIDN dibuat string matching dan Nama dosen dibuat Autocomplete
untuk hapus data diberi validasi yakin hapus data ?
4. menu mata kuliah ada 2 kurikulum (2017 & 2022) nanti ada dropdown untuk milih data yg di tampilan 
edit data mata kuliah untuk nama mata kuliah dibuat autocomplete, sks dan semester dibuat string matching
untuk hapus data diberi validasi yakin hapus data ?
5. edit data menu data ruang, bagian kapasitas dibuat string matching
untuk hapus data diberi validasi yakin hapus data ?

pkoknya gini mas, untuk nama dosen dan mata kuliah itu dibuat autocomplete
untuk NIDN, sks, semester, tahun akademik, kurikuluum, kapasitas dibuat strIng maching


