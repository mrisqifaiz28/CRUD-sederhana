<?php
session_start();

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    header("location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard & Sistem Informasi Akademik</title>
    <link rel="stylesheet" href="bootstrap-5-1-3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styleku.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }
        .wadah {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
            padding: 20px;
        }
        .kartu-dashboard {
            background-color: white;
            border-radius: 10px;
            padding: 15px;
            width: calc(50% - 20px);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 300px;
            margin-bottom: 20px;
        }
        .kartu-dashboard h2 {
            font-size: 1.2rem;
            margin-bottom: 8px;
            display: none;
        }
    
        .kartu-dashboard a {
            display: block;
            background-color: #007bff;
            color: white;
            padding: 8px 16px;
            border-radius: 5px;
            text-decoration: none;
            margin-top: 10px;
            font-size: 0.9rem;
        }
        .utama {
            margin: 20px;
            margin-left: 60px;
        }
        .info-mahasiswa {
            text-align: center;
            margin-top: 20px;
        }
        .bingkai-foto {
            display: inline-block;
            padding: 10px;
            border: 2px solid #ccc;
            border-radius: 10px;
            background-color: #f8f9fa;
            margin-bottom: 10px;
        }
        .foto-mahasiswa {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
        }
        .nama-mahasiswa, .nim-mahasiswa {
            margin-bottom: 5px;
        }

        @media (max-width: 768px) {
            .kartu-dashboard {
                width: calc(100% - 20px);
                max-width: none;
            }
        }
        
        @media (max-width: 480px) {
            .kartu-dashboard {
                width: 15px;
            }
        }
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var username = "<?php echo $username; ?>";
            alert("Selamat datang, " + username);
            
            var namaMahasiswa = document.querySelector(".Nama");
            var nimMahasiswa = document.querySelector(".Nim");

            namaMahasiswa.textContent = "Muhamad Risqi Faiz";
            nimMahasiswa.textContent = username;
        });
    </script>
</head>
<body>
    <?php require "head.html"; ?>

    <div class="wadah">
        <div class="kartu-dashboard">
            <a href="ajaxUpdateDosen2.php"> Data Dosen</a>
        </div>
        <div class="kartu-dashboard">
            <a href="ajaxUpdateMhs.php"> Data Mahasiswa</a>
        </div>
        <div class="kartu-dashboard">
            <a href="updateMatkul.php">Mata Kuliah<i class="fas fa-graduation-cap"></i></a>
        </div>
    </div>

    <div class="utama">
        <div class="wadah">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="info-mahasiswa">
                        <div class="bingkai-foto">
                            <img src="foto/profile.png" alt="Foto Mahasiswa" class="foto-mahasiswa">
                        </div>
                        <div class="Nim"></div>
                        <div class="Nama"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="bootstrap-5-1-3-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
