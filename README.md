# FrameworkNew
1 Этап: 
1.1 Создать гит репозиторий + https://github.com/suomalainenvitali/FrameworkNew +
1.2 создать минимальную структуру файлов + 
1.3 роутинг + 
1.4 основной класс приложения + 
1.5 создание класса Config +

1 Вопросы по окончанию этапа: 
1.1 Почему singltone называют антипаттерн? Синглтон нарушает SRP. Помимо того чтобы выполнять свои непосредственные обязанности, занимается еще и контролированием количества своих экземпляров. Глобальное состояние. Когда мы получаем доступ к экземпляру класса, мы не знаем текущее состояние этого класса, и кто и когда его менял, и это состояние может быть вовсе не таким, как ожидается. Корректность работы с синглтоном зависит от порядка обращений к нему, что вызывает неявную зависимость подсистем друг от друга и, как следствие, серьезно усложняет разработку. Зависимость обычного класса от синглтона не видна в публичном контракте класса. Так как обычно экземпляр синглтона не передается в параметрах метода, а получается напрямую, через GetInstance(), то для выявления зависимости класса от синглтона надо залезть в тело каждого метода — просто просмотреть публичный контракт объекта недостаточно. Наличие синглтона понижает тестируемость приложения в целом и классов, которые используют синглтон, в частности. 
1.2 Зачем нужен автолоад классов? Для того, чтобы при работе с классами из других файлов, не было необходимости в каждом файле прописывать зависимости в ручную, а обращаться к необходимым классам используя определенные неймспейсы, объявленные в классе. Автозагрузчик автоматически определит нахождение класса и подключит его файл, достаточно только указать правильный неймспейс (который в большинстве случаев автоматически проставляется в файле использующем класс средой разработки). 
1.3 Зачем нужен роутинг? Это маршрутизация: входящий URL разбирается специальным образом и по его результату выполняется определенный код. С роутингом напрямую связано понятие ЧПУ (человекопонятные урлы), которое позволяет исключить в адресах сложные параметры. Таким образом роутинг помогает сделать маршрутизацию более понятной, а также создать единую точку в приложении, через которую будут проходить все адреса и подгружаться необходимые данные. Обычно index.php в корневой папке сайта.

2 Этап: 
2.1 Создание класса реализующий multiton + 
2.2 init.php + 
2.2.1 Добавление константы подключения ядра (в init.php) и дальнейшее использование константы в подключаемых файлах + 
2.2.2 инициализация объекта Application + 
2.3 Создание структуры шаблона сайта + 
2.4 Доработка Application, внедрение буффера + 
2.5 Создание класса Page + 
2.6 Добавить инициализацию Page в конструктор Application в поле $pager + 
2.7 Создание страницы истории изменения проекта +


2 Вопросы по окончанию этапа 2.1 Как можно вызвать в конструкторе класса конструктор трейта? Переопределив название метода конструктора трейта. Пример: 

trait MyTrait { 
    
    private $a = 2;

    public function __construct() {
        $this->a = 10;
    }

    public function getA() {
        return $this->a;
    }
}

class MyClass { 
    use MyTrait { 
        MyTrait::__construct as __trait_construct; 
    }

    public function __construct()
    {
        $this->a = 5;
        $this->__trait_construct();
    }
} 

2.2 Предложите примеры задач, где бы вы могли ещё использовать буффер?

Aвтоматическая подсветка переменных.
Автоматическое распознавание URL и генерация ссылок.
Преобработка вводимых сообщений пользователя, например в чате, замена матов на *****.

2.3 В чём плюсы / минусы использования трейтов?
+
Позволяют дублировать код в классах и реализовать множественное наследование без необходимости создания единственного базового класса
Просты в использовании и открывают новые функциональные возможности
Делают код чистым, простым и эффективным
-
Отсутствие инкапсуляции
Так как в трейтах нет нормальной инкапсуляции, для того, чтобы хранить состояние приходится либо добавлять приватные поля в трейт, либо заводить статические переменные в методах
Использование static означает, что все объекты класса, использующие трейт, будут иметь общее состояние
Приватные поля трейта копируются в класс, так что возможны как конфликты имён, так и случайная модификация полей


3 Этап: 
3.1 Создание класса \Core\Type\Dictionary + 
3.2 Создание класса Request который наследуется от Dictionary + 
3.3 Создание класс Server который наследуется от Dictionary + 
3.4 Создание класс Session который наследуется от Dictionary + 
3.5 Доработка Application + 
3.6 Компоненты + 
3.7 Доработка Application + 
3.8 Доработка Page и буффер +

3 Вопросы по окончанию этапа: 
3.1 Как вы думаете, зачем нам компоненты? =) 
Функционал компонентов необходим, чтобы мы могли фабрично добавлять новые интерфейсные еденицы, которые предполагаем использовать в дальнейшем. 
Простыми словаи - создание готовых работающих элементов на странице, которые мы сможем всегда подключить, передав необходимые параметры, тем самым не верстая html код вручную.

4 Этап: 
4.1 Стилизовать наш сайт + 
4.2 Создать компонент рендера формы +

Элементы формы: 
input checkbox + 
input checkbox multiple + 
input email + 
input number + 
input password + 
input radio + 
input text + 
input text multiple + 
textarea + select + 
select multiple +