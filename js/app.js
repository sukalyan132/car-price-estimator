angular.module('staterApp',['dbtService.services'])
.controller('mainController',function($scope,$rootScope,API,usSpinnerService){
	$scope.stepOne=true;
	$scope.stepTwo=true;
	$scope.stepThree=true;
	// webservice for get car and outher details
	usSpinnerService.spin('spinner-1');
	$scope.sendData={'case':'carAndTripData'};
	API.post_details2($scope.sendData).success(function(data)
	{
		//console.log(data);
		$scope.car_details 	=data.car_details;
		$scope.vehicle_type =data.vehicle_type;
		$scope.trip_catagoty=data.trip_catagoty;
		usSpinnerService.stop('spinner-1');
		
	})
	$scope.tripData={'pickup':'','dropoff':'','carType':'','tripType':'','noOfPax':'','tripDate':'','customerName':'','emailId':'','phoneNo':'','case':'calculate_price','condition':''};
	// submit of stage one
	$scope.stepOneSubmit=function(){
		//console.log($scope.tripData.tripDate);
		//return false;
		$scope.pickupadd=false;
		$scope.dopadd 	=false;
		$scope.ctype 	=false;
		$scope.ttype 	=false;
		$scope.npax 	=false;
		$scope.tdate 	=false;
		if(!$scope.tripData.pickup)
		{
			$scope.pickupadd='true';
			return false;
		}
		if(!$scope.tripData.dropoff)
		{
			$scope.dopadd='true';
			return false;
		}
		if(!$scope.tripData.carType)
		{
			$scope.ctype='true';
			return false;
		}
		if(!$scope.tripData.tripType)
		{
			$scope.ttype='true';
			return false;
		}
		if(!$scope.tripData.noOfPax)
		{
			$scope.npax='true';
			return false;
		}
		if(!$scope.tripData.tripDate)
		{
			$scope.tdate='true';
			return false;
		}
		$scope.stepOne=false;
		$scope.stepTwo=false;
		$scope.stepThree=true;
	}
	// back to stage one
	$scope.backToStageOne=function(){
		$scope.stepOne=true;
		$scope.stepTwo=true;
		$scope.stepThree=true;
	}
	// get price 
	$scope.gatePrice=function(){
		$scope.cname 	=false;
		$scope.cemail	=false;
		$scope.cphone 	=false;
		$scope.tc 		=false;
		if(!$scope.tripData.customerName)
		{
			$scope.cname=true;
			return false;
		}
		if(!$scope.tripData.emailId)
		{
			$scope.cemail='true';
			return false;
		}
		if(!$scope.tripData.phoneNo)
		{
			$scope.cphone='true';
			return false;
		}
		if(!$scope.tripData.condition)
		{
			$scope.tc=true;
			return false;
		}
		
		 usSpinnerService.spin('spinner-1');
		API.post_details2($scope.tripData).success(function(data)
    	{
    		if(data.status=='true')
    		{
    			usSpinnerService.stop('spinner-1');
	    		console.log(data);
				$scope.stepOne=false;
				$scope.stepTwo=true;
				$scope.stepThree=false;
				$scope.resultData=data;
    		}
    		else
    		{
    			alert('Some issue in server please try again!');
    			usSpinnerService.stop('spinner-1');
    			return false;
    		}
		})
		
		

	}
	// back to step 2
	$scope.backToStageTwo=function(){
		$scope.stepOne=false;
		$scope.stepTwo=false;
		$scope.stepThree=true;
	}

$scope.reload = function()
{
   location.reload(); 
}
})

.factory('usSpinnerService', ['$rootScope', function ($rootScope) {
	var config = {};

	config.spin = function (key) {
		$rootScope.$broadcast('us-spinner:spin', key);
	};

	config.stop = function (key) {
		$rootScope.$broadcast('us-spinner:stop', key);
	};

	return config;
}])

.directive('usSpinner', ['$window', function ($window) {
	return {
		scope: true,
		link: function (scope, element, attr) {
			var SpinnerConstructor = Spinner || $window.Spinner;

			scope.spinner = null;

			scope.key = angular.isDefined(attr.spinnerKey) ? attr.spinnerKey : false;

			scope.startActive = angular.isDefined(attr.spinnerStartActive) ?
				attr.spinnerStartActive : scope.key ?
				false : true;

			scope.spin = function () {
				if (scope.spinner) {
					scope.spinner.spin(element[0]);
				}
			};

			scope.stop = function () {
				if (scope.spinner) {
					scope.spinner.stop();
				}
			};

			scope.$watch(attr.usSpinner, function (options) {
				scope.stop();
				scope.spinner = new SpinnerConstructor(options);
				if (!scope.key || scope.startActive) {
					scope.spinner.spin(element[0]);
				}
			}, true);

			scope.$on('us-spinner:spin', function (event, key) {
				if (key === scope.key) {
					scope.spin();
				}
			});

			scope.$on('us-spinner:stop', function (event, key) {
				if (key === scope.key) {
					scope.stop();
				}
			});

			scope.$on('$destroy', function () {
				scope.stop();
				scope.spinner = null;
			});
		}
	};
}])
 .directive('googleplace', function() {
    return {
        require: 'ngModel',
        link: function(scope, element, attrs, model) {
            var options = {
                types: [],
                componentRestrictions: {country: 'ie'}
            };
            scope.gPlace = new google.maps.places.Autocomplete(element[0], options);

            google.maps.event.addListener(scope.gPlace, 'place_changed', function() {
                scope.$apply(function() {
                    model.$setViewValue(element.val());                
                });
            });
        }
    }
  })
.directive('datepicker', function () {
    return {
        restrict: 'A',
        require: 'ngModel',
         link: function (scope, element, attrs, ngModelCtrl) {
            $(element).datepicker({
                dateFormat: 'dd-mm-yy',
                onSelect: function (date) {
                    scope.tripData.tripDate = date;
                    scope.$apply();
                }
            });
        }
    };
})

.directive("crBootstrapDatepicker", function(){
        return {
            restrict: "EAC",
            require: "ngModel",
            scope: {
                "ngModel": "="
            },
            link: function(scope, elem, attr){
                $(elem).datepicker({
                    format: "mm/dd/yyyy",
                }).on("changeDate", function(e){
                    return scope.$apply(function(){
                        return scope.ngModel = e.format();
                    });
                });

                return scope.$watch("ngModel", function(newValue){
                    $(elem).datepicker("update", newValue);
                });
            }
        };
    })
.filter('euroFormat', function () {
    return function (input) {
        return input+' \u20AC';
    };
})