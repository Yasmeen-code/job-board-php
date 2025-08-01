<?php
require_once 'includes/db.php';

$jobs = [
    [
        'title' => 'Frontend Developer',
        'description' => 'We are looking for a skilled frontend developer with experience in React.',
        'company' => 'TechWave',
        'location' => 'Cairo, Egypt',
        'salary' => '12,000 EGP',
        'user_id' => 6
    ],
    [
        'title' => 'Backend Developer',
        'description' => 'Join our backend team to build scalable APIs using Laravel.',
        'company' => 'CodeLab',
        'location' => 'Remote',
        'salary' => '15,000 EGP',
        'user_id' => 6
    ],
    [
        'title' => 'Graphic Designer',
        'description' => 'Creative designer needed for social media campaigns.',
        'company' => 'DesignPro',
        'location' => 'Alexandria, Egypt',
        'salary' => '9,000 EGP',
        'user_id' => 6
    ],
    [
        'title' => 'Data Analyst',
        'description' => 'Analyze market data and generate insightful reports.',
        'company' => 'InsightX',
        'location' => 'Giza, Egypt',
        'salary' => '14,000 EGP',
        'user_id' => 9
    ],
    [
        'title' => 'HR Manager',
        'description' => 'Responsible for hiring, training, and managing employee relations.',
        'company' => 'PeopleFirst',
        'location' => 'Cairo, Egypt',
        'salary' => '18,000 EGP',
        'user_id' => 9
    ]
];

$stmt = $pdo->prepare("INSERT INTO jobs (title, description, company, location, salary, user_id) VALUES (:title, :description, :company, :location, :salary, :user_id)");

foreach ($jobs as $job) {
    $stmt->execute([
        ':title' => $job['title'],
        ':description' => $job['description'],
        ':company' => $job['company'],
        ':location' => $job['location'],
        ':salary' => $job['salary'],
        ':user_id' => $job['user_id']
    ]);
}

echo "✅ Jobs inserted successfully!";
?>
