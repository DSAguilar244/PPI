<?php
header('Content-Type: application/json');

$uploadDir = '../static/img/';
$teamDataFile = 'team_data.json';

$response = ['success' => false, 'data' => [], 'message' => ''];

// Handle hero carousel image upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_FILES['images'])) {
    $uploadedFiles = [];
    $files = $_FILES['images'];
    for ($i = 0; $i < count($files['name']); $i++) {
        if ($files['error'][$i] === UPLOAD_ERR_OK) {
            $fileName = 'fondo_' . (count(glob($uploadDir . 'fondo_*.jpg')) + 1) . '.jpg';
            $filePath = $uploadDir . $fileName;
            if (move_uploaded_file($files['tmp_name'][$i], $filePath)) {
                $uploadedFiles[] = $filePath;
            }
        }
    }
    $response['success'] = !empty($uploadedFiles);
    $response['data'] = $uploadedFiles;
    $response['message'] = $response['success'] ? 'Images uploaded successfully' : 'Failed to upload images';
    echo json_encode($response);
    exit;
}

// Handle team member addition
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['name'])) {
    $teamData = file_exists($teamDataFile) ? json_decode(file_get_contents($teamDataFile), true) ?: [] : [];
    
    $newMember = [
        'name' => $_POST['name'],
        'title' => $_POST['title'],
        'description' => $_POST['description']
    ];

    if (!empty($_FILES['teamImage']['name']) && $_FILES['teamImage']['error'] === UPLOAD_ERR_OK) {
        $fileName = 'abogado_' . (count(glob($uploadDir . 'abogado_*.jpg')) + 1) . '.jpg';
        $filePath = $uploadDir . $fileName;
        if (move_uploaded_file($_FILES['teamImage']['tmp_name'], $filePath)) {
            $newMember['image'] = $filePath;
        }
    } else {
        $newMember['image'] = '../static/img/default_team.jpg';
    }

    $teamData[] = $newMember;
    file_put_contents($teamDataFile, json_encode($teamData, JSON_PRETTY_PRINT));
    
    $response['success'] = true;
    $response['data'] = $newMember;
    $response['message'] = 'Team member added successfully';
    echo json_encode($response);
    exit;
}

$response['message'] = 'Invalid request';
echo json_encode($response);
?>