<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "phpcrud";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle Create, Read, Update, Delete for Mahasiswa
if(isset($_POST['action'])) {
    $action = $_POST['action'];
    
    if($action == "create_mahasiswa") {
        $npm = $_POST['npm'];
        $namaMhs = $_POST['namaMhs'];
        $prodi = $_POST['prodi'];
        $alamat = $_POST['alamat'];
        $noHp = $_POST['noHp'];
        $sql = "INSERT INTO t_mahasiswa (npm, namaMhs, prodi, alamat, noHp) VALUES ('$npm', '$namaMhs', '$prodi', '$alamat', '$noHp')";
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } elseif($action == "read_mahasiswa") {
        $sql = "SELECT * FROM t_mahasiswa";
        $result = $conn->query($sql);
        $data = array();
        while($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        echo json_encode($data);
    } elseif($action == "update_mahasiswa") {
        $npm = $_POST['npm'];
        $namaMhs = $_POST['namaMhs'];
        $prodi = $_POST['prodi'];
        $alamat = $_POST['alamat'];
        $noHp = $_POST['noHp'];
        $sql = "UPDATE t_mahasiswa SET namaMhs='$namaMhs', prodi='$prodi', alamat='$alamat', noHp='$noHp' WHERE npm='$npm'";
        if ($conn->query($sql) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } elseif($action == "delete_mahasiswa") {
        $npm = $_POST['npm'];
        $sql = "DELETE FROM t_mahasiswa WHERE npm='$npm'";
        if ($conn->query($sql) === TRUE) {
            echo "Record deleted successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Handle Create, Read, Update, Delete for Matakuliah
if(isset($_POST['action'])) {
    $action = $_POST['action'];
    
    if($action == "create_matakuliah") {
        $kodeMK = $_POST['kodeMK'];
        $namaMK = $_POST['namaMK'];
        $sks = $_POST['sks'];
        $jam = $_POST['jam'];
        $sql = "INSERT INTO t_matakuliah (kodeMK, namaMK, sks, jam) VALUES ('$kodeMK', '$namaMK', '$sks', '$jam')";
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } elseif($action == "read_matakuliah") {
        $sql = "SELECT * FROM t_matakuliah";
        $result = $conn->query($sql);
        $data = array();
        while($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        echo json_encode($data);
    } elseif($action == "update_matakuliah") {
        $kodeMK = $_POST['kodeMK'];
        $namaMK = $_POST['namaMK'];
        $sks = $_POST['sks'];
        $jam = $_POST['jam'];
        $sql = "UPDATE t_matakuliah SET namaMK='$namaMK', sks='$sks', jam='$jam' WHERE kodeMK='$kodeMK'";
        if ($conn->query($sql) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } elseif($action == "delete_matakuliah") {
        $kodeMK = $_POST['kodeMK'];
        $sql = "DELETE FROM t_matakuliah WHERE kodeMK='$kodeMK'";
        if ($conn->query($sql) === TRUE) {
            echo "Record deleted successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Handle Create, Read, Update, Delete for Dosen
if(isset($_POST['action'])) {
    $action = $_POST['action'];
    
    if($action == "create_dosen") {
        $namaDosen = $_POST['namaDosen'];
        $noHp = $_POST['noHp'];
        $sql = "INSERT INTO t_dosen (namaDosen, noHp) VALUES ('$namaDosen', '$noHp')";
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } elseif($action == "read_dosen") {
        $sql = "SELECT * FROM t_dosen";
        $result = $conn->query($sql);
        $data = array();
        while($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        echo json_encode($data);
    } elseif($action == "update_dosen") {
        $idDosen = $_POST['idDosen'];
        $namaDosen = $_POST['namaDosen'];
        $noHp = $_POST['noHp'];
        $sql = "UPDATE t_dosen SET namaDosen='$namaDosen', noHp='$noHp' WHERE idDosen='$idDosen'";
        if ($conn->query($sql) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } elseif($action == "delete_dosen") {
        $idDosen = $_POST['idDosen'];
        $sql = "DELETE FROM t_dosen WHERE idDosen='$idDosen'";
        if ($conn->query($sql) === TRUE) {
            echo "Record deleted successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Handle Search
if(isset($_GET['search'])) {
    $keyword = $_GET['keyword'];
    $type = $_GET['type'];
    $sql = "";

    if($type == "mahasiswa") {
        $sql = "SELECT * FROM t_mahasiswa WHERE namaMhs LIKE '%$keyword%'";
    } elseif($type == "matakuliah") {
        $sql = "SELECT * FROM t_matakuliah WHERE namaMK LIKE '%$keyword%'";
    } elseif($type == "dosen") {
        $sql = "SELECT * FROM t_dosen WHERE namaDosen LIKE '%$keyword%'";
    }

    $result = $conn->query($sql);
    $data = array();
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode($data);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Akademik</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
        }
        .container {
            margin-bottom: 20px;
        }
        h2 {
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }
        form {
            margin-bottom: 20px;
        }
        input[type="text"], input[type="number"] {
            padding: 5px;
            margin: 5px 0;
            display: block;
        }
        button {
            padding: 10px 15px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>CRUD Akademik</h1>
    
    <div class="container">
        <h2>Mahasiswa</h2>
        <form id="mahasiswaForm">
            <input type="text" id="mahasiswaNpm" placeholder="NPM">
            <input type="text" id="mahasiswaNamaMhs" placeholder="Nama Mahasiswa">
            <input type="text" id="mahasiswaProdi" placeholder="Prodi">
            <input type="text" id="mahasiswaAlamat" placeholder="Alamat">
            <input type="text" id="mahasiswaNoHp" placeholder="No HP">
            <button type="button" onclick="createMahasiswa()">Tambah Mahasiswa</button>
            <button type="button" onclick="updateMahasiswa()">Update Mahasiswa</button>
        </form>
        <div id="mahasiswaList"></div>
    </div>
    
    <div class="container">
        <h2>Matakuliah</h2>
        <form id="matakuliahForm">
            <input type="text" id="matakuliahKodeMK" placeholder="Kode Matakuliah">
            <input type="text" id="matakuliahNamaMK" placeholder="Nama Matakuliah">
            <input type="text" id="matakuliahSks" placeholder="SKS">
            <input type="text" id="matakuliahJam" placeholder="Jam">
            <button type="button" onclick="createMatakuliah()">Tambah Matakuliah</button>
            <button type="button" onclick="updateMatakuliah()">Update Matakuliah</button>
        </form>
        <div id="matakuliahList"></div>
    </div>
    
    <div class="container">
        <h2>Dosen</h2>
        <form id="dosenForm">
            <input type="text" id="dosenIdDosen" placeholder="id Dosen">
            <input type="text" id="dosenNamaDosen" placeholder="Nama Dosen">
            <input type="text" id="dosenNoHp" placeholder="No HP">
            <button type="button" onclick="createDosen()">Tambah Dosen</button>
            <button type="button" onclick="updateDosen()">Update Dosen</button>
        </form>
        <div id="dosenList"></div>
    </div>
    
    <div class="container">
        <h2>Pencarian</h2>
        <input type="text" id="searchKeyword" placeholder="Cari nama...">
        <select id="searchType">
            <option value="mahasiswa">Mahasiswa</option>
            <option value="matakuliah">Matakuliah</option>
            <option value="dosen">Dosen</option>
        </select>
        <button type="button" onclick="search()">Cari</button>
        <div id="searchResult"></div>
    </div>

    <script>
        function createMahasiswa() {
            var npm = document.getElementById('mahasiswaNpm').value;
            var namaMhs = document.getElementById('mahasiswaNamaMhs').value;
            var prodi = document.getElementById('mahasiswaProdi').value;
            var alamat = document.getElementById('mahasiswaAlamat').value;
            var noHp = document.getElementById('mahasiswaNoHp').value;
            var formData = new FormData();
            formData.append('action', 'create_mahasiswa');
            formData.append('npm', npm);
            formData.append('namaMhs', namaMhs);
            formData.append('prodi', prodi);
            formData.append('alamat', alamat);
            formData.append('noHp', noHp);

            fetch('studikasus.php', {
                method: 'POST',
                body: formData
            }).then(response => response.text())
            .then(data => {
                alert(data);
                readMahasiswa();
            });
        }

        function readMahasiswa() {
            var formData = new FormData();
            formData.append('action', 'read_mahasiswa');

            fetch('studikasus.php', {
                method: 'POST',
                body: formData
            }).then(response => response.json())
            .then(data => {
                var list = document.getElementById('mahasiswaList');
                list.innerHTML = '';
                data.forEach(item => {
                    var div = document.createElement('div');
                    div.innerHTML = 'NPM: ' + item.npm + ', Nama: ' + item.namaMhs + ', Prodi: ' + item.prodi + ', Alamat: ' + item.alamat + ', No HP: ' + item.noHp +
                                    ' <button onclick="editMahasiswa(\'' + item.npm + '\')">Edit</button>' +
                                    ' <button onclick="deleteMahasiswa(\'' + item.npm + '\')">Delete</button>';
                    list.appendChild(div);
                });
            });
        }

        function editMahasiswa(npm) {
            var formData = new FormData();
            formData.append('action', 'read_mahasiswa');

            fetch('studikasus.php', {
                method: 'POST',
                body: formData
            }).then(response => response.json())
            .then(data => {
                data.forEach(item => {
                    if(item.npm == npm) {
                        document.getElementById('mahasiswaNpm').value = item.npm;
                        document.getElementById('mahasiswaNamaMhs').value = item.namaMhs;
                        document.getElementById('mahasiswaProdi').value = item.prodi;
                        document.getElementById('mahasiswaAlamat').value = item.alamat;
                        document.getElementById('mahasiswaNoHp').value = item.noHp;
                    }
                });
            });
        }

        function updateMahasiswa() {
            var npm = document.getElementById('mahasiswaNpm').value;
            var namaMhs = document.getElementById('mahasiswaNamaMhs').value;
            var prodi = document.getElementById('mahasiswaProdi').value;
            var alamat = document.getElementById('mahasiswaAlamat').value;
            var noHp = document.getElementById('mahasiswaNoHp').value;
            var formData = new FormData();
            formData.append('action', 'update_mahasiswa');
            formData.append('npm', npm);
            formData.append('namaMhs', namaMhs);
            formData.append('prodi', prodi);
            formData.append('alamat', alamat);
            formData.append('noHp', noHp);

            fetch('studikasus.php', {
                method: 'POST',
                body: formData
            }).then(response => response.text())
            .then(data => {
                alert(data);
                readMahasiswa();
            });
        }

        function deleteMahasiswa(npm) {
            var formData = new FormData();
            formData.append('action', 'delete_mahasiswa');
            formData.append('npm', npm);

            fetch('studikasus.php', {
                method: 'POST',
                body: formData
            }).then(response => response.text())
            .then(data => {
                alert(data);
                readMahasiswa();
            });
        }

        function createMatakuliah() {
            var kodeMK = document.getElementById('matakuliahKodeMK').value;
            var namaMK = document.getElementById('matakuliahNamaMK').value;
            var sks = document.getElementById('matakuliahSks').value;
            var jam = document.getElementById('matakuliahJam').value;
            var formData = new FormData();
            formData.append('action', 'create_matakuliah');
            formData.append('kodeMK', kodeMK);
            formData.append('namaMK', namaMK);
            formData.append('sks', sks);
            formData.append('jam', jam);

            fetch('studikasus.php', {
                method: 'POST',
                body: formData
            }).then(response => response.text())
            .then(data => {
                alert(data);
                readMatakuliah();
            });
        }

        function readMatakuliah() {
            var formData = new FormData();
            formData.append('action', 'read_matakuliah');

            fetch('studikasus.php', {
                method: 'POST',
                body: formData
            }).then(response => response.json())
            .then(data => {
                var list = document.getElementById('matakuliahList');
                list.innerHTML = '';
                data.forEach(item => {
                    var div = document.createElement('div');
                    div.innerHTML = 'Kode MK: ' + item.kodeMK + ', Nama: ' + item.namaMK + ', SKS: ' + item.sks + ', Jam: ' + item.jam +
                                    ' <button onclick="editMatakuliah(\'' + item.kodeMK + '\')">Edit</button>' +
                                    ' <button onclick="deleteMatakuliah(\'' + item.kodeMK + '\')">Delete</button>';
                    list.appendChild(div);
                });
            });
        }

        function editMatakuliah(kodeMK) {
            var formData = new FormData();
            formData.append('action', 'read_matakuliah');

            fetch('studikasus.php', {
                method: 'POST',
                body: formData
            }).then(response => response.json())
            .then(data => {
                data.forEach(item => {
                    if(item.kodeMK == kodeMK) {
                        document.getElementById('matakuliahKodeMK').value = item.kodeMK;
                        document.getElementById('matakuliahNamaMK').value = item.namaMK;
                        document.getElementById('matakuliahSks').value = item.sks;
                        document.getElementById('matakuliahJam').value = item.jam;
                    }
                });
            });
        }

        function updateMatakuliah() {
            var kodeMK = document.getElementById('matakuliahKodeMK').value;
            var namaMK = document.getElementById('matakuliahNamaMK').value;
            var sks = document.getElementById('matakuliahSks').value;
            var jam = document.getElementById('matakuliahJam').value;
            var formData = new FormData();
            formData.append('action', 'update_matakuliah');
            formData.append('kodeMK', kodeMK);
            formData.append('namaMK', namaMK);
            formData.append('sks', sks);
            formData.append('jam', jam);

            fetch('studikasus.php', {
                method: 'POST',
                body: formData
            }).then(response => response.text())
            .then(data => {
                alert(data);
                readMatakuliah();
            });
        }

        function deleteMatakuliah(kodeMK) {
            var formData = new FormData();
            formData.append('action', 'delete_matakuliah');
            formData.append('kodeMK', kodeMK);

            fetch('studikasus.php', {
                method: 'POST',
                body: formData
            }).then(response => response.text())
            .then(data => {
                alert(data);
                readMatakuliah();
            });
        }

        function createDosen() {
            var namaDosen = document.getElementById('dosenNamaDosen').value;
            var noHp = document.getElementById('dosenNoHp').value;
            var formData = new FormData();
            formData.append('action', 'create_dosen');
            formData.append('namaDosen', namaDosen);
            formData.append('noHp', noHp);

            fetch('studikasus.php', {
                method: 'POST',
                body: formData
            }).then(response => response.text())
            .then(data => {
                alert(data);
                readDosen();
            });
        }

        function readDosen() {
            var formData = new FormData();
            formData.append('action', 'read_dosen');

            fetch('studikasus.php', {
                method: 'POST',
                body: formData
            }).then(response => response.json())
            .then(data => {
                var list = document.getElementById('dosenList');
                list.innerHTML = '';
                data.forEach(item => {
                    var div = document.createElement('div');
                    div.innerHTML = 'ID Dosen: ' + item.idDosen + ', Nama: ' + item.namaDosen + ', No HP: ' + item.noHp +
                                    ' <button onclick="editDosen(' + item.idDosen + ')">Edit</button>' +
                                    ' <button onclick="deleteDosen(' + item.idDosen + ')">Delete</button>';
                    list.appendChild(div);
                });
            });
        }

        function editDosen(idDosen) {
            var formData = new FormData();
            formData.append('action', 'read_dosen');

            fetch('studikasus.php', {
                method: 'POST',
                body: formData
            }).then(response => response.json())
            .then(data => {
                data.forEach(item => {
                    if(item.idDosen == idDosen) {
                        document.getElementById('dosenIdDosen').value = item.idDosen;
                        document.getElementById('dosenNamaDosen').value = item.namaDosen;
                        document.getElementById('dosenNoHp').value = item.noHp;
                    }
                });
            });
        }

        function updateDosen() {
            var idDosen = document.getElementById('dosenIdDosen').value;
            var namaDosen = document.getElementById('dosenNamaDosen').value;
            var noHp = document.getElementById('dosenNoHp').value;
            var formData = new FormData();
            formData.append('action', 'update_dosen');
            formData.append('idDosen', idDosen);
            formData.append('namaDosen', namaDosen);
            formData.append('noHp', noHp);

            fetch('studikasus.php', {
                method: 'POST',
                body: formData
            }).then(response => response.text())
            .then(data => {
                alert(data);
                readDosen();
            });
        }

        function deleteDosen(idDosen) {
            var formData = new FormData();
            formData.append('action', 'delete_dosen');
            formData.append('idDosen', idDosen);

            fetch('studikasus.php', {
                method: 'POST',
                body: formData
            }).then(response => response.text())
            .then(data => {
                alert(data);
                readDosen();
            });
        }

        function search() {
            var keyword = document.getElementById('searchKeyword').value;
            var type = document.getElementById('searchType').value;

            fetch('studikasus.php?search=true&keyword=' + keyword + '&type=' + type)
            .then(response => response.json())
            .then(data => {
                var list = document.getElementById('searchResult');
                list.innerHTML = '';
                data.forEach(item => {
                    var div = document.createElement('div');
                    if(type == 'mahasiswa') {
                        div.innerHTML = 'NPM: ' + item.npm + ', Nama: ' + item.namaMhs + ', Prodi: ' + item.prodi + ', Alamat: ' + item.alamat + ', No HP: ' + item.noHp;
                    } else if(type == 'matakuliah') {
                        div.innerHTML = 'Kode MK: ' + item.kodeMK + ', Nama: ' + item.namaMK + ', SKS: ' + item.sks + ', Jam: ' + item.jam;
                    } else if(type == 'dosen') {
                        div.innerHTML = 'ID Dosen: ' + item.idDosen + ', Nama: ' + item.namaDosen + ', No HP: ' + item.noHp;
                    }
                    list.appendChild(div);
                });
            });
        }

        // Initial read
        readMahasiswa();
        readMatakuliah();
        readDosen();
    </script>
</body>
</html>
