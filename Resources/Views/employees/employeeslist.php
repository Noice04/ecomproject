<?php

namespace views;

/* The view can be written as HTML + PHP
OR we can use OOP and make it a class. 
*/
use core\auth\MembershipProvider;

class EmployeeList{

    

    public function render($data){

    if(isset($_GET['logout'])){
        session_start();
        session_destroy();
    }

        $membership = new MembershipProvider();
    if ($membership->isLoggedIn()){

       require("Resources\\Views\\templates\\header.php");

        $html = "
        <table>
            <thead>
                <tr>
                    <th>EmployeeID</th>
                    <th>FirstName</th>
                    <th>LastName</th>
                    <th>Position</th>
                </tr>
        </thead>";

            foreach ($data as $employee) {
                $html .= "<tr>";
                $html .= "<td>{$employee["employeeID"]}</td>";
                $html .= "<td>{$employee["firstName"]}</td>";
                $html .= "<td>{$employee["lastName"]}</td>";
                $html .= "<td>{$employee["title"]}</td>";
                $html .= "</tr>";
            }
        $html .='</table>
                <br>
                <a href="/app/employees?logout">Log Out</a>
        ';

      
        echo $html;  

        require("Resources\\Views\\templates\\footer.php");
        }
        else{
            header('location: /app/logins');
        }
       // return $html;
    }
}  