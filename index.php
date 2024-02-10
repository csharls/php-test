<?php
require_once __DIR__ . '/vendor/autoload.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <div class="container-fluid">
        <nav class="navbar bg-body-tertiary shadow-sm">
            <div class="container-fluid">
                <span class="navbar-brand mb-0 h1">📱 The messages app </span>
            </div>
        </nav>

        <div class="row pt-5">
            <main class="col-6 d-flex">
                <form action="POST" class="mx-auto shadow-sm border px-3 boxed rounded">
                    <div>
                        <h2 class="my-3">Send a message</h2>
                        <small>Write a phone number or a list of phone numbers</small>
                        <div class="form-floating mb-3">
                            <input type="tel" value="" id="to" class="form-control" name="to" placeholder="write a phone number" required pattern="^(\+\d{11}(,\+\d{11})*)?$">
                            <label for="to"> To:
                            </label>
                        </div>
                        <div class="mb-3 form-floating">
                            <textarea class="form-control" id="message" name="message" cols="40" rows="3" required></textarea>
                            <label for="message"> Message:
                            </label>
                        </div>
                        <div class="mb-3 d-flex">

                            <button class="btn btn-primary ms-auto" id="send-btn" type="button">
                                <span role="status">Send</span>
                            </button>
                        </div>
                    </div>
                </form>
            </main>
            <section class="col-6">
                <h2 class="mb-3">Previous messages 📃</h2>

                <table class="table table-stripped" id="latest-messages">
                    <thead>
                        <tr>
                            <th id="sort-id" class="sortable">#</th>
                            <th id="sort-to" class="sortable">To</th>
                            <th id="sort-mesage" class="sortable">Message</th>
                            <th>Twilio sid</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">

                    </tbody>

                </table>
            </section>

        </div>
    </div>

    <script src="js/messages.js" async></script>
</body>

</html>