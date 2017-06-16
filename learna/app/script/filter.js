/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

///<reference path="script/script.js"/>
myApp.filter("gender", function(){
            return function(gender){
                gender = parseInt(gender);
                switch(gender){
                    case 1:
                        return "Male";
                        break;
                    case 2:
                        return "Female";
                    case 3:
                        return "Gender Undefined";  
                }
            };
});



        