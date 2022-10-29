var app = angular.module("myApp", []);

app.controller("myCtrl", function ($scope, $http, $interval,$timeout,$window) {

    $scope.ticket = function(){
    $http({
        method: "GET",
        url: "api/service.ticket.php",
        params: {}
      }).then(function mySuccess(response) {
          $scope.ticketCode = response.data.ticketCode;
          var tcode = response.data.ticketCode;
          $scope.makeCode(tcode);
        }, function myError(response) {
          return response.statusText;
      });
    }

      $interval(function () {
        $http({
            method: "GET",
            url: "api/service.status.php",
            params: {}
        }).then(function mySuccess(response) {
            var st = ['รอ..','กำลังดำเนินการ','เสร็จแล้ว','ส่งงานแล้ว'];
            var s = response.data.tStatus;
            $scope.tstatus = s;
            $scope.jobStatus = st[s];
            }, function myError(response) {
            return response.statusText;
        });
    }, 5000);

    /*
    $scope.caim = function(){
      $http({
          method: "GET",
          url: "api/service.caim.php",
          params: {}
        }).then(function mySuccess(response) {
            $scope.caimCode = response.data.caimCode;
            var ccode = response.data.caimCode;
            $scope.makeCode(ccode);
          }, function myError(response) {
            return response.statusText;
        });
      }
  
        $interval(function () {
          $http({
              method: "GET",
              url: "api/caim.status.php",
              params: {}
          }).then(function mySuccess(response) {
              var sc = ['รอ..','กำลังดำเนินการ','เสร็จแล้ว','ส่งงานแล้ว'];
              var c = response.data.cStatus;
              $scope.cStatus = c;
              $scope.caimStatus = sc[c];
              }, function myError(response) {
              return response.statusText;
          });
      }, 5000);

      */
     
    $scope.makeCode = function(tcode) {		
        JsBarcode("#Barcode128",tcode, {
                    format:"CODE128",
                    displayValue:false
                    });
    };

    $scope.makeTime = function() {	
        $interval(function () {
        $scope.CurrentDate = new Date();
        }, $scope.interval);
    };

    $scope.wait = 0;

    });