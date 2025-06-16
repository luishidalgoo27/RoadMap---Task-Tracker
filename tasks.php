<?php

// Recoge el archivo json
const filename = __DIR__ . '/tasks.json';

function loader(): array
{
    if (!file_exists(filename)) return []; // Si el archivo no existe te devuelve un array vacio.
    $content = file_get_contents(filename); // Lee el contenido y lo guarda en el array.
    $tasks = json_decode($content, true); // Convierte el json en un array.
    if(!is_array($tasks)) return []; // Si es un array lo retorna, si no es un array (error) retorna un array vacio.

    $validated = []; // Array de tareas validadas

    foreach($tasks as $task) { // Recorre las tareas
        if(is_array($task) && validate($task)) { // Si la tarea es un array y esta validada se añade al array
            $validated[] = $task;
        }
    }

    return $validated; // Devuelve el array de tareas validadas.

}

function validate(array $task): bool {
    $validStatus = ['todo', 'in_progress', 'done'];

    return isset($task['id'], $task['description'], $task['status'], $task['created_at'], $task['updated_at']) &&
        is_numeric($task['id']) &&
        is_string($task['description']) &&
        in_array($task['status'], $validStatus, true) &&
        strtotime($task['created_at']) !== false &&
        strtotime($task['updated_at']) !== false; 
}

function save(array $tasks): void
{
    file_put_contents(filename, json_encode($tasks, JSON_PRETTY_PRINT)); 
}

function getNextId(array $tasks): int
{
    if(empty($tasks)) return 1; // Si el array esta vacio empieza por 1
    $ids = array_column($tasks, 'id'); // Coge la columna de ids 
    return max($ids) + 1; // Y devuelve el más alto + 1
}

function create(int $id, string $description)
{
    $date = date('Y-m-d H:i:s');
    return [
        'id' => $id,
        'description' => $description,
        'status' => "todo",
        'created_at' => $date,
        'updated_at' => $date,
    ];
}

function store(string $description)
{   
    $tasks = loader();
    $id = getNextId($tasks);
    $newTask = create($id, $description);
    $tasks[] = $newTask;
    save($tasks);
    echo "Task added successfully (ID: " . $newTask['id'] . ")\n";
}

function update(int $id, string $description)
{
    $tasks = loader();
    $found = false;
    foreach($tasks as &$task){
        if($task['id'] == $id) { 
            $task['description'] = $description;
            $task['updated_at'] = date('Y-m-d H:i:s');
            $found = true;
            break;
        }
    }
    if (!$found) {
        echo "❌ Task with ID $id not found.\n";
        return;
    }
    save($tasks);
    echo "Task updated successfully (ID: $id)\n";
}

function delete(int $id)
{
    $tasks = loader();
    foreach ($tasks as $i => $task){
        if($task['id'] == $id) {
            $index = $i;
            break;
        }
    }

    if($index === null){
        echo "❌ ID not found.\n";
        return;
    }

    array_splice($tasks, $index, 1);
    save($tasks);

    echo "Task deleted successfully (ID: $id)\n";
}

function markinprogress(int $id)
{
    $tasks = loader();
    $complete = false;
    foreach ($tasks as &$task)
    {
        if($task['id'] == $id)
        {
            if($task['status'] == 'in-progress'){
                $complete = false;
                break;
            }

            $task['status'] = "in-progress";
            $complete = true;
            break;
        }
    }

    if (!$complete)
    {
        echo "❌ The task is already in-progress.\n";
        return;
    }
    save($tasks);
    echo "Task mark in progress succesfully (ID: $id)\n";
}

function markdone(int $id)
{
    $tasks = loader();
    $complete = false;
    foreach ($tasks as &$task)
    {
        if($task['id'] == $id)
        {
            if($task['status'] == 'done'){
                $complete = false;
                break;
            }

            $task['status'] = "done";
            $complete = true;
            break;
        }
    }

    if (!$complete)
    {
        echo "❌ The task is already done.\n";
        return;
    }
    save($tasks);
    echo "Task mark in progress succesfully (ID: $id)\n";
}

function listTasks()
{
    $tasks = loader();
    foreach($tasks as $task)
    {
        echo "-----------------------------\n";
        echo "ID - " . $task['id'] . "\n";
        echo "DESCRIPTION - " . $task['description'] . "\n";
        echo "STATUS - " . $task['status'] . "\n";
        echo "CREATED AT - " . $task['created_at'] . "\n";
        echo "UPDATED AT - " . $task['updated_at'] . "\n";
    }
}

function listByStatus(string $status)
{
    $tasks = loader();
    foreach($tasks as $task)
    {
        if($task['status'] == $status){
            echo "-----------------------------\n";
            echo "ID - " . $task['id'] . "\n";
            echo "DESCRIPTION - " . $task['description'] . "\n";
            echo "STATUS - " . $task['status'] . "\n";
            echo "CREATED AT - " . $task['created_at'] . "\n";
            echo "UPDATED AT - " . $task['updated_at'] . "\n";
        }
    }
}

global $argc, $argv;

if ($argc < 2) {
    echo "Use:\n";
    echo "  php tasks.php add \"description\"\n";
    echo "  php tasks.php update \"id\" \"description\" \n";
    echo "  php tasks.php delete \"id\"\n";
    echo "  php tasks.php mark-in-progress \"id\"\n";
    echo "  php tasks.php mark-done \"id\"\n";
    echo "  php tasks.php list \n";
    echo "  php tasks.php list done \n";
    echo "  php tasks.php list todo \n";
    echo "  php tasks.php list in-progress \n";
    exit(1);
}

$comando = $argv[1];

switch ($comando) {
    case 'add':
        if (!isset($argv[2])) {
            echo "❌ The description is required.\n";
            exit(1);
        }
        store($argv[2]);
        break;

    case 'update':
        if (!isset($argv[2]) || !isset($argv[3])) {
            echo "❌ The id and description is required.\n";
            exit(1);
        }
        update($argv[2], $argv[3]);
        break;
        

    case 'delete':
        if (!isset($argv[2])){
            echo "❌ The id of task is required.\n";
            exit(1);
        }
        delete($argv[2]);
        break;

    case 'mark-in-progress':
        if (!isset($argv[2])){
            echo "❌ The id of task is required.\n";
            exit(1);
        }
        markinprogress($argv[2]);
        break;

    case 'mark-done':
        if (!isset($argv[2])){
            echo "❌ The id of task is required.\n";
            exit(1);
        }
        markdone($argv[2]);
        break;
    
        case 'list':
        if (!isset($argv[2])){
            listTasks();
            break;
        }
        listByStatus($argv[2]);
        break;
    
    case 'help':
        echo "Use:\n";
        echo "  php tasks.php add \"description\"\n";
        echo "  php tasks.php update \"id\" \"description\" \n";
        echo "  php tasks.php delete \"id\"\n";
        echo "  php tasks.php mark-in-progress \"id\"\n";
        echo "  php tasks.php mark-done \"id\"\n";
        echo "  php tasks.php list \n";
        echo "  php tasks.php list done \n";
        echo "  php tasks.php list todo \n";
        echo "  php tasks.php list in-progress \n";
        exit(1);
        break;

    default:
        echo "❓ Command not found: $comando\n";
        echo "🔎 Use: php tasks.php help\n";
        break;
}
?>