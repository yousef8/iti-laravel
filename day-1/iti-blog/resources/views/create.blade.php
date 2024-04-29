<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Posts</title>
</head>
<body>
<div class="container-xl pt-4">

    <h1>Add Post</h1>

    <form class="mt-4">
        <div class="form-floating mb-3">
        <input type="text" name="title" class="form-control" id="title" placeholder="name@example.com">
        <label for="title">Title</label>
        </div>

        <div class="form-floating">
        <textarea class="form-control" name="body" placeholder="Comment Body" id="body" style="height: 100px"></textarea>
        <label for="body">Body</label>
        </div>

        <div class="mb-3">
        <label for="formFile" class="form-label">Post Cover Image</label>
        <input class="form-control" name="image_url" type="file" id="formFile">
        </div>

        <input class="btn btn-success" type="submit" value="Add">

    </form>

</div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
