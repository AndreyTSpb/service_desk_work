<?PHP
class Model_Order_Answers extends Mysql
{
    public $id;
    public $dt;
    public $text;
    public $users_id;
    public $orders_id;

    public function fieldsTable()
    {
        return array(
            'id'                => 'id',
            'dt'                => 'dt',
            'text'              => 'text',
            'users_id'          => 'users_id',
            'orders_id'         => 'orders_id'
        );
    }
}