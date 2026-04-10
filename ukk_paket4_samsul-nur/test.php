<?php
session_start();

// Define base URL
define('BASE_URL', 'http://localhost/ukk_paket4_samsul-nur');

// Test database connection
require_once 'app/Config/Database.php';

try {
    $db = new Database();
    $conn = $db->getConnection();

    if ($conn) {
        echo "<h2 style='color: green;'>✅ Database connection successful!</h2>";

        // Test query
        $result = $conn->query("SELECT COUNT(*) as total FROM users");
        if ($result) {
            $row = $result->fetch_assoc();
            echo "<p style='color: green;'>✅ Users table exists with {$row['total']} records</p>";
        } else {
            echo "<p style='color: red;'>❌ Users table not found</p>";
        }

        $result = $conn->query("SELECT COUNT(*) as total FROM books");
        if ($result) {
            $row = $result->fetch_assoc();
            echo "<p style='color: green;'>✅ Books table exists with {$row['total']} records</p>";
        } else {
            echo "<p style='color: red;'>❌ Books table not found</p>";
        }

        $result = $conn->query("SELECT COUNT(*) as total FROM borrows");
        if ($result) {
            $row = $result->fetch_assoc();
            echo "<p style='color: green;'>✅ Borrows table exists with {$row['total']} records</p>";
        } else {
            echo "<p style='color: red;'>❌ Borrows table not found</p>";
        }

        echo "<hr>";
        echo "<h3>🎉 Setup completed successfully!</h3>";
        echo "<p><a href='" . BASE_URL . "' target='_blank'>🚀 Go to Application</a></p>";
        echo "<p><strong>Default Admin Login:</strong></p>";
        echo "<ul>";
        echo "<li>Email: <code>admin@perpustakaan.com</code></li>";
        echo "<li>Password: <code>admin123</code></li>";
        echo "</ul>";

        echo "<p><strong>Sample User Accounts:</strong></p>";
        echo "<ul>";
        echo "<li><code>ahmad@email.com</code> / <code>admin123</code></li>";
        echo "<li><code>siti@email.com</code> / <code>admin123</code></li>";
        echo "<li><code>rudi@email.com</code> / <code>admin123</code></li>";
        echo "</ul>";

    } else {
        echo "<h2 style='color: red;'>❌ Database connection failed!</h2>";
    }
} catch (Exception $e) {
    echo "<h2 style='color: red;'>❌ Error: " . $e->getMessage() . "</h2>";
    echo "<h3>Please make sure:</h3>";
    echo "<ul>";
    echo "<li>XAMPP/MySQL is running</li>";
    echo "<li>Database 'perpustakaan12' exists</li>";
    echo "<li>Database credentials are correct in app/Config/Database.php</li>";
    echo "<li>You have imported the database.sql file</li>";
    echo "</ul>";
}
?>