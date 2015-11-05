(function(angular, $, _) {

  angular.module('contactpcp').config(function($routeProvider) {
      $routeProvider.when('/contactpcp/index-angular/:cid', {
        controller: 'ContactpcpIndexCtrl',
        templateUrl: '~/contactpcp/IndexCtrl.html',

        // If you need to look up data when opening the page, list it out
        // under "resolve".
        resolve: {
          pages: function(crmApi, $route) {
            return crmApi('Campaignpage', 'index', {
              contact_id: $route.current.params.cid
            });
          }
        }
      });
    }
  );

  // The controller uses *injection*. This default injects a few things:
  //   $scope -- This is the set of variables shared between JS and HTML.
  //   crmApi, crmStatus, crmUiHelp -- These are services provided by civicrm-core.
  //   myContact -- The current contact, defined above in config().
  angular.module('contactpcp').controller('ContactpcpIndexCtrl', function($scope, crmApi, crmStatus, crmUiHelp, pages) {
    var ts = $scope.ts = CRM.ts('contactpcp');
    var hs = $scope.hs = crmUiHelp({file: 'CRM/contactpcp/IndexCtrl'}); // See: templates/CRM/contactpcp/IndexCtrl.hlp

    var setLinksForPages = function(x) {
      x.pageLink = CRM.url('civicrm/pcp/info', {reset:1, id: x.id});
      x.editLink = CRM.url('civicrm/pcp/info', {reset:1, id: x.id, action: 'update'});

      return x;
    };
    $scope.pages = _.map(pages.values, setLinksForPages);
    $scope.pages = pages.values;
  });

})(angular, CRM.$, CRM._);
