///<reference path="script/angular.min.js"/>

var myApp = angular.module("myModule", [])
        .controller('myController', function ($scope) {
//    var employee = [
//        {firstName: "Daniel", lastName: "Mutwiri", gender: "Male", salary: 70000 },
//        {firstName: "Mutwiri", lastName: "Daniel", gender: "Male", salary: 80000 },
//        {firstName: "Gitonga", lastName: "M'Mtungi", gender: "Male", salary: 90000 },
//        {firstName: "M'Mtungi", lastName: "Gitonga", gender: "Male", salary: 100000 },
//        {firstName: "Daniel", lastName: "Mutwiri", gender: "Male", salary: 70000 },
//        {firstName: "Mutwiri", lastName: "Daniel", gender: "Male", salary: 80000 },
//        {firstName: "Gitonga", lastName: "M'Mtungi", gender: "Male", salary: 90000 },
//        {firstName: "M'Mtungi", lastName: "Gitonga", gender: "Male", salary: 100000 }
//    
//    ];

//    var country = [
//        {name: "UK", 
//            cities: [
//                {name: "London"},
//                {name: "Liverpool"},
//                {name: "Manchester"}
//            ]
//        },
//        {name: "Kenya", 
//            cities: [
//                {name: "Nairobi"},
//                {name: "Mombasa"},
//                {name: "Kisumu"},
//                {name: "Nakuru"}
//            ]
//        },
//        {name: "Tanzania", 
//            cities: [
//                {name: "Dodoma"},
//                {name: "Dar es Salaam"},
//                {name: "Moshi"},
//                {name: "Tabora"}
//            ]
//        },
//        {name: "Uganda", 
//            cities: [
//                {name: "Kampala"},
//                {name: "Entebe"},
//                {name: "Jinja"},
//                {name: "Lira"}
//            ]
//        }
//    ];

//    var technologies = [
//        {name: "C#",likes:0, dislikes: 0},
//        {name: "ASP.NET",likes:0, dislikes: 0},
//        {name: "SQL Server",likes:0, dislikes: 0},
//        {name: "C++",likes:0, dislikes: 0},
//        {name: "PHP",likes:0, dislikes: 0},
//        {name: "AngularJS",likes:0, dislikes: 0},
//        {name: "MySQL",likes:0, dislikes: 0}
//    ];
//    $scope.technologies = technologies;
//    
//    $scope.incrementLikes = function(technology){
//      technology.likes ++;  
//    };
//    
//    $scope.incrementDeslikes = function(technology){
//        technology.dislikes ++;
//    }

    var employees = [
        {name: "Den", dateOfBirth: new Date("November 23, 1980"), gender: 1, salary: 55000.78}, 
        {name: "Dan", dateOfBirth: new Date("December 24, 1982"), gender: 1, salary: 55010.78},
        {name: "Ben", dateOfBirth: new Date("October 25, 1983"), gender: 3, salary: 55020.78},
        {name: "Josh", dateOfBirth: new Date("September 26, 1984"), gender: 1, salary: 55030.78},
        {name: "Steve", dateOfBirth: new Date("August 27, 1985"), gender: 3, salary: 55040.78},
        {name: "Liz", dateOfBirth: new Date("July 28, 1986"), gender: 2, salary: 55050.78},
        {name: "Ellen", dateOfBirth: new Date("June 29, 1987"), gender: 2, salary: 55060.78},
        {name: "Jack", dateOfBirth: new Date("Janaury 30, 1988"), gender:1, salary: 55070.78}
    ];
    
    $scope.employees = employees;
    $scope.rowLimit = 10;
    $scope.orderColumn = "name";
    $scope.reverseSort = false;
    
    $scope.sortDate = function(column){
        $scope.reverseSort = ($scope.orderColumn === column) ? !$scope.reverseSort: false;
        $scope.orderColumn = column;
    };
    
    $scope.getSortClass = function(column){
        if($scope.orderColumn === column){
            return $scope.reverseSort ? 'arrow_down' : 'arrow_up';
        }
        
        return '';
    };
    $scope.search = function(item){
        if($scope.searchText === undefined){
            return true;
        }else{
            if(item.name.toLowerCase().indexOf($scope.searchText.toLowerCase()) != -1 || item.gender.toLowerCase().indexOf($scope.searchText.toLowerCase()) != -1){
                return true;
            }
        }
        return false;
    };
});
