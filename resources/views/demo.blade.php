<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demo</title>
    @vite(["resources/css/app.css", "resources/js/app.js"])
</head>

<body>
    <h1>
        Socket Demo page
    </h1>
    <form action="{{route('create')}}" method="post">
       @csrf
        <button type="submit">Call Event</button>
    </form>
</body>

<script>
    setTimeout(() => {
        window.Echo.channel('public-chat')
            .listen('DemoEvent', (e) => {
                console.log(e.message);
            })
    }, 200);
</script>

</html>