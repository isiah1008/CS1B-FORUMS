<?php
require 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum Page</title>
    <link rel="stylesheet" href="styles5.css">
</head>
<body>
    <header>
        <h1>CS1B Forum</h1>
        <nav>
            <a href="forum.php" class="home-button">Home</a>
        </nav>
    </header>
    <main>
        <section class="forum-container" id="forum-container">
            <?php
            $sql = "SELECT * FROM posts ORDER BY created_at DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='post'>";
                    echo "<h2>" . htmlspecialchars($row['title']) . "</h2>";
                    echo "<p>Posted by " . htmlspecialchars($row['username']) . " on " . $row['created_at'] . "</p>";
                    echo "<p>" . htmlspecialchars($row['content']) . "</p>";
                    echo "</div>";
                }
            } else {
                echo "<p>No posts yet. Be the first to post!</p>";
            }
            ?>
        </section>

        <section class="new-post">
            <h2>Create a New Post</h2>
            <form id="post-form">
                <input type="text" id="title" name="title" placeholder="Title" required>
                <input type="text" id="username" name="username" placeholder="Your Name (Optional)">
                <textarea id="content" name="content" placeholder="Write your post here..." required></textarea>
                <button type="submit">Post</button>
            </form>
        </section>
    </main>

    <script>
        document.getElementById("post-form").addEventListener("submit", function(event) {
            event.preventDefault(); 

            let title = document.getElementById("title").value;
            let username = document.getElementById("username").value || "Anonymous"; 
            let content = document.getElementById("content").value;

            fetch("post.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: "title=" + encodeURIComponent(title) + 
                      "&username=" + encodeURIComponent(username) + 
                      "&content=" + encodeURIComponent(content)
            })
            .then(response => response.text())
            .then(data => {
                document.getElementById("forum-container").innerHTML = data; 
                document.getElementById("post-form").reset(); 
            })
            .catch(error => console.error("Error:", error));
        });
    </script>
</body>
</html>
