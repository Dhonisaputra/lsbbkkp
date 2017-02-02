angular.module('assessment_setup', [])
.controller('sse_checker_all_schedules', function($scope, $http){
    
    $scope.sse_checker_all_schedules_notify = false
    $scope.sse_checker_unconfirmed_schedules_notify = false
    $scope.sse_checker_confirmed_single_schedules_notify = false
    $scope.sse_checker_confirmed_group_schedules_notify = false
    
    if (typeof(EventSource) !== "undefined") {
        // Yes! Server-sent events support!
        var source = new EventSource(site_url('assessment/sse_all_schedules'));
        source.onmessage = function (event) {

            var i = 1, 
                url = URL.get(),
                json = JSON.parse(event.data),
                jsonFilter = []


            url.hash.dataBottom = (url.hash.dataBottom)? url.hash.dataBottom : moment().add(3,'months').format("YYYY, MMM 01");
            url.hash.dataTop = (url.hash.dataTop)? url.hash.dataTop : moment().format("YYYY, MMM 01");

            $.each(json['all_schedule'], function(a,b){

                var isValid = ( moment(b.deadline, 'YYYY-MM-DD').isBetween(url.hash.dataTop, url.hash.dataBottom, 'month', '[}')  )? true : false;
                
                if(isValid || !moment(b.deadline).isValid() )
                {
                    jsonFilter.push(b);
                }
            })
            
            
            if($scope.sse_checker_all_schedules_notify == false && window.completeSchedules.data().length !== jsonFilter.length)
            {
               $scope.$apply(function(){
                    $scope.sse_checker_all_schedules_notify = true;
                })
               var n = new Notification('LSBBKKP Notification', {
                    body : 'there is the changed data in the table ALL SCHEDULES. click here to refresh or click the refresh button in top of page to refresh all schedule!',
                    sticky: true,
                })
                n.onclick = function(){
                    n.close();
                    window.completeSchedules.ajax.reload();
                }
                n.onclose = function(){
                    $scope.$apply(function(){
                        $scope.sse_checker_all_schedules_notify = false;
                    })
                }
            }

            if($scope.sse_checker_unconfirmed_schedules_notify == false && window.unconfirmedSchedules.data().length !== json.unconfirmed_assessment.length)
            {
               $scope.$apply(function(){
                    $scope.sse_checker_unconfirmed_schedules_notify = true;
                })
               var n = new Notification('LSBBKKP Notification', {
                    body : 'there is the changed data in the table UNCONFIRMED SCHEDULES. click here to refresh or click the refresh button in top of page to refresh all schedule!',
                    sticky: true,
                })
                n.onclick = function(){
                    n.close();
                    window.unconfirmedSchedules.ajax.reload();
                }
                n.onclose = function(){
                    $scope.$apply(function(){
                        $scope.sse_checker_unconfirmed_schedules_notify = false;
                    })
                }

            }

            if($scope.sse_checker_confirmed_single_schedules_notify == false && window.tableConfirmedSingle.data().length !== json.confirmed_single.length)
            {
               $scope.$apply(function(){
                    $scope.sse_checker_confirmed_single_schedules_notify = true;
                })
               var n = new Notification('LSBBKKP Notification', {
                    body : 'there is the changed data in the table CONFIRMED ASSESSMENT AS SINGLE . click here to refresh or click the refresh button in top of page to refresh all schedule!',
                    sticky: true,
                })
                n.onclick = function(){
                    n.close();
                    window.tableConfirmedSingle.ajax.reload();
                }
                n.onclose = function(){
                    $scope.$apply(function(){
                        $scope.sse_checker_confirmed_single_schedules_notify = false;
                    })
                }

            }

            if($scope.sse_checker_confirmed_group_schedules_notify == false && window.tableConfirmedGroup.data().length !== json.confirmed_group.length)
            {
               $scope.$apply(function(){
                    $scope.sse_checker_confirmed_group_schedules_notify = true;
                })
               var n = new Notification('LSBBKKP Notification', {
                    body : 'there is the changed data in the table CONFIRMED ASSESSMENT AS GROUP. click here to refresh or click the refresh button in top of page to refresh all schedule!',
                    sticky: true,
                })
                n.onclick = function(){
                    n.close();
                    window.tableConfirmedGroup.ajax.reload();
                }
                n.onclose = function(){
                    $scope.$apply(function(){
                        $scope.sse_checker_confirmed_group_schedules_notify = false;
                    })
                }
            }
        }
    } else {
        // Sorry! No server-sent events support..
        alert('SSE not supported by browser.');
    }

})

