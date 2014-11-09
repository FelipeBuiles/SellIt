#!/usr/bin/env node

var pluginlist = [
    "org.apache.cordova.device",
    "org.apache.cordova.camera",
    "org.apache.cordova.inappbrowser",
    "com.ionic.keyboard"
];

var fs = require('fs');
var path = require('path');
var sys = require('sys')
var exec = require('child_process').exec;

function puts(error, stdout, stderr) {
    sys.puts(stdout)
}

pluginlist.forEach(function(plug) {
    exec("cordova plugin add " + plug, puts);
});
