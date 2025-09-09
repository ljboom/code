var express = require('express');
var app = express();

app.use(express.static('./dist'));

app.listen(2333);

console.log('访问localhost:2333')
// 天美社区源码网 timibbs.net timibbs.com timibbs.vip
