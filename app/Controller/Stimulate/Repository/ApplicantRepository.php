<?php
namespace App\Controller\Stimulate\Repository;


class ApplicantRepository
{

     public function findOne($criteria = [])
     {
         $sql[] = 'SELECT * FROM applicant';
         foreach ($criteria as $field => $value)
         {
             // AND WHERE ....
             $sql[] = 'WHERE '. $field .' = :'. $field;
         }

         $sqlDL = join('AND', $sql);

         // Excecute
         $pdo = new \PDO('mysql:host=127.0.0.1', 'root', '', []);
         $stmt = $pdo->prepare($sqlDL);
         $stmt->execute($criteria);
          // SELECT * FROM applicant WHERE
     }
}