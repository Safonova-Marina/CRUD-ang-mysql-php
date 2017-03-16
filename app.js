// Для работы данного примера необходимо устаноивть http://deployd.com/
// Инструкции по установке в Overview-Ajax.xps

angular.module("exampleApp", [])
.constant("baseUrl", "users.php")
.controller("defaultCtrl", function ($scope, $http, baseUrl) {

    // текущее педставление
    $scope.currentView = "table";

    // получение всех данных из модели
    $scope.refresh = function () {
        // HTTP GET
        // получение всех данных через GET запрос по адрес хранящемуся в baseUrl
        //console.log('ha');
        $http.get(baseUrl).success(function (data) {
            $scope.items = data;
            //console.log($scope.items);
        });
    }

    // создание нового элемента
    $scope.create = function (item) {
        // HTTP POST
        // Отправка POST запроса для создания новой записи на сервере
        $http.post(baseUrl, item).success(function () {
            console.log(item);
            //$scope.items.push(item);
            $scope.refresh();
            $scope.currentView = "table";
        });
    }

    // обновление элемента
    $scope.update = function (item) {
        // HTTP PUT
        // Отправка PUT запроса для обновления определенной записи на сервере
        $http({
            url: baseUrl,
            method: "PUT",
            data: item
        }).success(function () {
            for (var i = 0; i < $scope.items.length; i++) {
                if ($scope.items[i].id == item.id) {
                    $scope.items[i] = item;
                    break;
                }
            }
            //$scope.refresh();
            $scope.currentView = "table";
        });
    }

    // удаление элемента из модели
    $scope.delete = function (item) {
        // HTTP DELETE
        // отправка DELETE запроса по адресу http://localhost:2403/items/id что приводит к удалению записей на сервере
        //console.log('ha delete', item);
        $http({
            method: "DELETE",
            url: baseUrl + "?id=" + item.id,
            //data: ({item: item})
        }).success(function () {
            //$scope.refresh();
            $scope.items.splice($scope.items.indexOf(item), 1);
            //$scope.items.splice($scope.items.indexOf(item), 1);
        });
    }

    // редеактирование существующего или создание нового элемента
    $scope.editOrCreate = function (item) {
        $scope.currentItem = item ? angular.copy(item) : {};
        $scope.currentView = "edit";
    }

    // сохранение изменений
    $scope.saveEdit = function (item) {
        // Если у элемента есть свойство id выполняем редактирование
        // В данной реализации новые элементы не получают свойство id поэтому редактировать их невозможно (будет исправленно в слудующих примерах)
            if (angular.isDefined(item.id)) {
                $scope.update(item);
            } else {
                $scope.create(item);
            }
    }

    // отмена изменений и возврат в представление table
    $scope.cancelEdit = function () {
        $scope.currentItem = {};
        $scope.currentView = "table";
    }

    $scope.refresh();
});