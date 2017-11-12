<?PHP
    echo $data = date("d/m/Y");  
    echo "||||||";
    echo $data = substr($data,6,4)."-".substr($data,3,2)."-".substr($data,0,2);
    
?>