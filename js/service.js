angular.module('dbtService.services', [])
    .factory('API', function ( $http) {
	var base = "http://192.168.100.132/dbtmobile/";
	var base2= "http://localhost/travelpro/webservice/webservice.php";
	//var base = "http://180.151.3.101/dbtmobile/";
	//var base2= "http://180.151.3.101/dbtmobile/";
        return {
					get_details : function (url) {
						return $http.get(base,
											  {
												  method : 'GET',  
												  headers:{'Content-Type': 'application/json'}
											  }
											  );
						
					},
					post_details2 : function (form) {
						return $http.post(base2,
											form,
											  {
												  method : 'POST',  
												 // headers:{"Content-Type": "application/json"}
												  headers: { 'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'},
											  }
											  );
						
					},
					post_details : function (form,url) {
						return $http.post(base+url,
											 form,
											  {
												  method : 'POST',  
												  headers:{'Content-Type': 'application/x-www-form-urlencoded'}
											  }
											  );
						
					}
				}
    });