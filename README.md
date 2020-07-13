## Задача: Реализовать REST-API для указанных маршрутов на Laravel
## Использованный стек: LAPP(Linux Apache PostgreSQL PHP7.3)

## Ход выполнения:<br>
# /App/Models
1) Созданы модели Staff(Сотрудники), Article(Новости медицины), User(По умолчанию с коробки) а так же миграции к ним.<br> 
# /Database/migrations 
2) Дописан метод up() в файлах миграции, для создания табличной структуры.  
# /Database/seeds
3) Добавлены сиды, для фейкового заполнения данными таблиц.
# /App/Http/Controllers
4) Созданы контоллеры ArticleController(index, show, store, update, delete), StaffContoller(index, show).

## Скриншоты локальной БД PostgreSQL <br>

# Сотрудники
![alt text](https://sun9-24.userapi.com/Wqfe1ygim_8GysCbCQWnqRozwrPRLPXDDcHHBg/2kY3SH22Dvs.jpg)
<br>
# Новости медицины
![alt text](https://sun9-24.userapi.com/Wqfe1ygim_8GysCbCQWnqRozwrPRLPXDDcHHBg/2kY3SH22Dvs.jpg)





Для полноценного тестирования нужен токен от авторизации, которой нету исходя из условии. Вот тест примерный: <br>

ArticleTest.php <br>
```
class ArticleTest extends TestCase
{
    public function testsArticlesAreCreatedCorrectly()
    {
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];
        $payload = [
            'title' => 'Lorem',
            'body' => 'Ipsum',
        ];

        $this->json('POST', '/api/articles', $payload, $headers)
            ->assertStatus(200)
            ->assertJson(['id' => 1, 'title' => 'Lorem', 'body' => 'Ipsum']);
    }

    public function testsArticlesAreUpdatedCorrectly()
    {
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];
        $article = factory(Article::class)->create([
            'title' => 'First Article',
            'body' => 'First Body',
        ]);

        $payload = [
            'title' => 'Lorem',
            'body' => 'Ipsum',
        ];

        $response = $this->json('PUT', '/api/articles/' . $article->id, $payload, $headers)
            ->assertStatus(200)
            ->assertJson([ 
                'id' => 1, 
                'title' => 'Lorem', 
                'body' => 'Ipsum' 
            ]);
    }

    public function testsArtilcesAreDeletedCorrectly()
    {
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];
        $article = factory(Article::class)->create([
            'title' => 'First Article',
            'body' => 'First Body',
        ]);

        $this->json('DELETE', '/api/articles/' . $article->id, [], $headers)
            ->assertStatus(204);
    }

    public function testArticlesAreListedCorrectly()
    {
        factory(Article::class)->create([
            'title' => 'First Article',
            'body' => 'First Body'
        ]);

        factory(Article::class)->create([
            'title' => 'Second Article',
            'body' => 'Second Body'
        ]);

        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];

        $response = $this->json('GET', '/api/articles', [], $headers)
            ->assertStatus(200)
            ->assertJson([
                [ 'title' => 'First Article', 'body' => 'First Body' ],
                [ 'title' => 'Second Article', 'body' => 'Second Body' ]
            ])
            ->assertJsonStructure([
                '*' => ['id', 'body', 'title', 'created_at', 'updated_at'],
            ]);
    }

}

```
