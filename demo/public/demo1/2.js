var http = require('http');
var mysql = require('mysql');

http.createServer(function (req, res) {

    res.writeHead(200, {'Content-Type': 'text/html'});

    var connection = mysql.createConnection({
        host     : '192.168.7.249',
        user     : 'root',
        password : '123456',
        database : 'sc'
    });

    connection.connect();

    connection.query('SELECT * from user', function (error, results, fields) {
        if (error) throw error;

        res.end(results[0].username);
        // console.log('The solution is: ', results[0].role_name);
    })
