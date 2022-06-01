function favourite() {
    // Get the checkbox
    var checkBox = document.getElementById("checkbox");
    var mysql = require('mysql');  
    var con = mysql.createConnection({  
    host: "localhost",  
    user: "root",  
    password: "",  
    database: "hbms"  
    });  
  
    // If the checkbox is checked, display the output text
    if (checkBox.checked == true){
        con.connect(function (err){
            if (err) throw err;
            var sql = "INSERT INTO favourite (favID, custID, hotelID) VALUES ('', '$custID', '$hotelID')";  
            con.query(sql,function(err,result)){

            };
        });
 
    }else {
 
    }
}
        