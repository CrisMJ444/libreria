<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Iniciar sesión</title>
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; min-height: 100vh; display: grid; grid-template-columns: 1.1fr 1fr; font-family: system-ui, -apple-system, "Segoe UI", Roboto, sans-serif; color: #1d1b3a; background: #fff; }
        .lado { background: linear-gradient(135deg, #2e2490 0%, #5b4bdb 55%, #a24bf0 100%); color: #fff; padding: 48px; display: flex; flex-direction: column; justify-content: space-between; position: relative; overflow: hidden; }
        .marca { display: flex; align-items: center; gap: 10px; font-weight: 600; font-size: 18px; position: relative; z-index: 1; }
        .logo { width: 38px; height: 38px; border-radius: 10px; background: rgba(255,255,255,.18); display: grid; place-items: center; font-size: 21px; }
        .texto { position: relative; z-index: 1; }
        .texto h1 { font-size: 40px; line-height: 1.1; margin: 0 0 12px; letter-spacing: -.8px; }
        .texto p { margin: 0; font-size: 17px; opacity: .88; max-width: 420px; line-height: 1.5; }
        .lomos { position: absolute; right: -10px; bottom: 0; display: flex; align-items: flex-end; gap: 10px; opacity: .22; }
        .lomos i { display: block; width: 38px; background: #fff; border-radius: 6px 6px 0 0; }
        .lomos i:nth-child(1) { height: 170px; } .lomos i:nth-child(2) { height: 230px; }
        .lomos i:nth-child(3) { height: 140px; } .lomos i:nth-child(4) { height: 260px; }
        .lomos i:nth-child(5) { height: 190px; } .lomos i:nth-child(6) { height: 220px; }
        .pie { font-size: 13px; opacity: .75; position: relative; z-index: 1; }

        .form-lado { display: flex; align-items: center; justify-content: center; padding: 32px; background: #f5f4fc; }
        .card { width: 100%; max-width: 380px; }
        .card h2 { font-size: 28px; margin: 0 0 6px; letter-spacing: -.4px; }
        .sub { color: #6e6c8a; margin: 0 0 24px; font-size: 15px; }
        label { display: block; font-size: 13px; color: #6e6c8a; margin: 16px 0 6px; font-weight: 500; }
        input { width: 100%; font: inherit; font-size: 15px; padding: 12px 14px; border: 1px solid #e0def0; border-radius: 12px; background: #fff; }
        input:focus { outline: 2px solid #5b4bdb; outline-offset: 0; border-color: transparent; }
        button { width: 100%; margin-top: 24px; font: inherit; font-size: 16px; font-weight: 600; padding: 13px; border: none; border-radius: 12px; background: #5b4bdb; color: #fff; cursor: pointer; }
        button:hover { background: #4638b8; }
        .error { background: #fdeceb; color: #a32d2d; font-size: 14px; padding: 11px 14px; border-radius: 12px; margin-bottom: 4px; }
        .hint { margin-top: 20px; font-size: 13px; color: #6e6c8a; background: #fff; border: 1px dashed #d6d3ee; border-radius: 12px; padding: 12px 14px; }
        .hint b { color: #1d1b3a; font-weight: 600; }

        @media (max-width: 800px) {
            body { grid-template-columns: 1fr; }
            .lado { padding: 28px; min-height: 220px; }
            .texto h1 { font-size: 28px; }
            .lomos { display: none; }
        }
    </style>
</head>
<body>
    <section class="lado">
        <div class="marca"><span class="logo">&#128214;</span> Biblioteca</div>
        <div class="texto">
            <h1>Tu catálogo de libros, en un solo lugar.</h1>
            <p>Administra títulos, autores y colecciones con una API REST construida en Laravel.</p>
        </div>
        <div class="pie">Proyecto U3 &middot; Laravel + Eloquent + MySQL</div>
        <div class="lomos"><i></i><i></i><i></i><i></i><i></i><i></i></div>
    </section>

    <section class="form-lado">
        <div class="card">
            <h2>Bienvenido</h2>
            <p class="sub">Inicia sesión para ver el catálogo.</p>

            @if ($errors->any())
                <div class="error">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="/login">
                @csrf
                <label for="email">Correo</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" autofocus autocomplete="username" placeholder="correo@ejemplo.com">

                <label for="password">Contraseña</label>
                <input id="password" type="password" name="password" autocomplete="current-password" placeholder="••••••••">

                <button type="submit">Entrar</button>
            </form>

            <p class="hint">Cuenta de prueba: <b>admin@libros.test</b> &middot; <b>admin123</b></p>
        </div>
    </section>
</body>
</html>
