<?php

class OperacijeBaze
{
    private $servername;
    private $user;
    private $password;

    public function __construct()
    {
        $this -> servername = "localhost";
        $this -> user = "mysql";
        $this -> password = "ASczi0ov*12=-=+1456";
    }

    private function enkriptuj($sifra)
    {
        return password_hash($sifra, PASSWORD_BCRYPT, ['cost' => 12]);
    }

    private function connect($baza)
    {
        $conn = new mysqli($this->servername, $this->user, $this->password, $baza);

        if ($conn -> connect_error) {
            die("Neuspesna konekcija sa bazom. " . $conn->connect_error);
            return;
        }

        return $conn;
    }

    public function pronadjiEmail($email)
    {
      $conn = $this -> connect('upravljanje_projektima');
      $sql = sprintf("SELECT * FROM user WHERE email='%s'", $email);
      $res = $conn -> query($sql);
      $conn -> close();
      return $res;
    }

    public function loginUsera($email, $sifra) {

      $res = $this -> pronadjiEmail($email);
      
      if ($res -> num_rows == 0) return FALSE;

      if (password_verify($sifra, $res->fetch_assoc()["sifra"])) return TRUE;

      return FALSE;

    }
    
    public function napraviUsera($email, $sifra, $ime, $prezime) {
      
      $conn = $this -> connect('upravljanje_projektima');
      $sql = sprintf("INSERT INTO user (email, sifra, ime, prezime) VALUES ('%s', '%s', '%s', '%s')",
      $email, $this -> enkriptuj($sifra), $ime, $prezime);

      if ($conn -> query($sql) === TRUE) {
        $conn -> close();
        return;
      } else {
        die("SQL greska!\n" . $sql . "\n" . $conn->error);
      }

    }

    public function napraviProjekat($naziv, $vazno, $rok) {
      
      $conn = $this -> connect('upravljanje_projektima');
      $sql = sprintf("INSERT INTO projekti (naziv, vazno, rok) VALUES ('%s', %d, '%s')", $naziv, $vazno, $rok);

      if ($conn -> query($sql) === TRUE) {
        $id = $conn->insert_id;
        $conn->close();
        return $id;
      } else {
        die("SQL greska!\n" . $sql . "\n" . $conn->error);
      }

    }

    public function napraviKomentar($id_stavke, $komentar) {
      $conn = $this -> connect('upravljanje_projektima');
      $sql = sprintf("INSERT INTO komentari (komentar, id_stavke) VALUES ('%s', %d)", $komentar, $id_stavke);

      if ($conn -> query($sql) === TRUE) {
        $id = $conn->insert_id;
        $conn->close();
        return $id;
      } else {
        die("SQL greska!\n" . $sql . "\n" . $conn->error);
      }

    }

    public function izmeniProjekat($id, $naziv, $vazno, $rok) {
      
      $conn = $this -> connect('upravljanje_projektima');
      $sql = sprintf("UPDATE projekti SET naziv='%s', vazno=%d, rok='%s' WHERE id=%d", $naziv, $vazno, $rok, $id);

      if ($conn -> query($sql) === TRUE) {
        $id = $conn->insert_id;
        $conn->close();
        return $id;
      } else {
        die("SQL greska!\n" . $sql . "\n" . $conn->error);
      }

    }

    public function izmeniKomentar($id, $komentar) {
      
      $conn = $this -> connect('upravljanje_projektima');
      $sql = sprintf("UPDATE komentari SET komentar='%s' WHERE id=%d", $komentar, $id);

      if ($conn -> query($sql) === TRUE) {
        $conn->close();
      } else {
        die("SQL greska!\n" . $sql . "\n" . $conn->error);
      }

    }

    public function izmeniStatus($id, $status) {
      
      $conn = $this -> connect('upravljanje_projektima');
      $sql = sprintf("UPDATE stavke SET status=%d WHERE id=%d", $status, $id);

      if ($conn -> query($sql) === TRUE) {
        $conn->close();
      } else {
        die("SQL greska!\n" . $sql . "\n" . $conn->error);
      }

    }

    public function ukloniProjekat($id) {
      
      $conn = $this -> connect('upravljanje_projektima');
      $sql = sprintf("DELETE FROM projekti WHERE id=%d", $id);

      if ($conn -> query($sql) === TRUE) {
        $id = $conn->insert_id;
        $conn->close();
        return $id;
      } else {
        die("SQL greska!\n" . $sql . "\n" . $conn->error);
      }

    }

    public function napraviStavku($id_projekta, $naziv, $vazno, $rok, $status, $id_usera) {

      $conn = $this -> connect('upravljanje_projektima');
      $sql = sprintf("INSERT INTO stavke (id_projekta, naziv, vazno, rok, status, id_usera) 
      VALUES (%d, '%s', %d, '%s', %d, %d)", 
      $id_projekta, $naziv, $vazno, $rok, $status, $id_usera);

      if ($conn -> query($sql) === TRUE) {
        $id = $conn->insert_id;
        $conn->close();
        return $id;
      } else {
        die("SQL greska!\n" . $sql . "\n" . $conn->error);
      }

    }


    public function izmeniStavku($id, $id_projekta, $naziv, $vazno, $rok, $status, $id_usera = null) {

      $conn = $this -> connect('upravljanje_projektima');
      $sql = null;

      if ($id_usera == null) {
        $sql = sprintf("UPDATE stavke SET id_projekta=%d, naziv='%s', vazno=%d, rok='%s', status=%d WHERE id=%d", 
        $id_projekta, $naziv, $vazno, $rok, $status, $id);
      }
      else {
        $sql = sprintf("UPDATE stavke SET id_projekta=%d, naziv='%s', vazno=%d, rok='%s', status=%d, id_usera=%d WHERE id=%d", 
        $id_projekta, $naziv, $vazno, $rok, $status, $id_usera, $id);
      }

      if ($conn -> query($sql) === TRUE) {
        $id = $conn->insert_id;
        $conn->close();
        return $id;
      } else {
        die("SQL greska!\n" . $sql . "\n" . $conn->error);
      }

    }

    public function izmeniUseraStavke($id, $id_usera) {

      $conn = $this -> connect('upravljanje_projektima');
      $sql = sprintf("UPDATE stavke SET id_usera=%d WHERE id=%d", 
      $id_usera, $id);

      if ($conn -> query($sql) === TRUE) {
        $conn->close();
      } else {
        die("SQL greska!\n" . $sql . "\n" . $conn->error);
      }

    }

    public function izmeniUlogu($id, $uloga) {

      $conn = $this -> connect('upravljanje_projektima');
      $sql = sprintf("UPDATE user SET uloga='%s' WHERE id=%d", 
      $uloga, $id);

      if ($conn -> query($sql) === TRUE) {
        $conn->close();
      } else {
        die("SQL greska!\n" . $sql . "\n" . $conn->error);
      }

    }

    public function izmeniTemuUsera($id, $tema) {

      $conn = $this -> connect('upravljanje_projektima');
      $sql = sprintf("UPDATE user SET tema=%d WHERE id=%d", 
      $tema, $id);

      if ($conn -> query($sql) === TRUE) {
        $conn->close();
      } else {
        die("SQL greska!\n" . $sql . "\n" . $conn->error);
      }

    }

    public function ukloniStavkeProjekta($id) {

      $conn = $this -> connect('upravljanje_projektima');
      $sql = sprintf("DELETE FROM stavke WHERE id_projekta=%d", $id);

      if ($conn -> query($sql) === TRUE) {
        $id = $conn->insert_id;
        $conn->close();
        return $id;
      } else {
        die("SQL greska!\n" . $sql . "\n" . $conn->error);
      }

    }


    public function ukloniUsera($id) {

      $conn = $this -> connect('upravljanje_projektima');
      $sql = sprintf("DELETE FROM user WHERE id=%d", $id);

      if ($conn -> query($sql) === TRUE) {
        $conn->close();
      } else {
        die("SQL greska!\n" . $sql . "\n" . $conn->error);
      }

    }

    public function selectSve($tabela) {
      
      $conn = $this -> connect('upravljanje_projektima');
      $sql = sprintf('SELECT * FROM %s', $tabela);

      $res = $conn -> query($sql);

      $conn -> close();
      
      return $res;
    
    }

    public function selectUserMailpoId($id) {
      
      if($id == -1) {
        return "Nije zadato";
      }

      $conn = $this -> connect("upravljanje_projektima");
      $sql = sprintf("SELECT * FROM user WHERE id=%d", $id);

      $res = $conn -> query($sql);

      if ($res -> num_rows > 0) {
          return $res -> fetch_assoc() ["email"];
      } else {
        return "Nije zadato";
      }
    }

    public function selectIdUseraStavke($stavka_id) {
      $conn = $this -> connect("upravljanje_projektima");
      $sql = sprintf("SELECT * FROM stavke WHERE id=%d", $stavka_id);
       
      $res = $conn -> query($sql); 
      $res = $res -> fetch_assoc();

      if ($res["id_usera"] == -1) {
        return -1;
      }
      else {
        
        return $res["id_usera"];

      }

    }

    public function selectUseraStavke($stavka_id) {
      $conn = $this -> connect("upravljanje_projektima");
      $sql = sprintf("SELECT * FROM stavke WHERE id=%d", $stavka_id);
       
      $res = $conn -> query($sql); 
      $res = $res -> fetch_assoc();

      if ($res["id_usera"] == -1) {
        return -1;
      }
      else {
        
        $user = $this->selectUserMailpoId($res["id_usera"]);

        return $user -> fetch_assoc() ["email"];

      }

    }

    public function selectKomentarPoIdStavke($id_stavke) {
      $conn = $this -> connect("upravljanje_projektima");
      $sql = sprintf("SELECT * FROM komentari WHERE id_stavke=%d", $id_stavke);
       
      $res = $conn -> query($sql); 
      if ($res -> num_rows > 0) {
          $res = $res -> fetch_assoc();
          return $res;
      }
      
      return null;

    }

    public function idUseraPoMail($mail) {

      $conn = $this -> connect("upravljanje_projektima");
      $sql = sprintf("SELECT * FROM user WHERE email='%s'", $mail);
       
      $res = $conn -> query($sql); 

      return $res;
    }

    public function selectPoIdProjekta($projekatId) {
      
      $conn = $this -> connect('upravljanje_projektima');
      $sql = sprintf("SELECT * FROM stavke WHERE id_projekta=%d", $projekatId);
      $res = $conn -> query($sql);

      $conn -> close();

      return $res;

    }

}
