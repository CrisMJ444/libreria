<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Catálogo de libros</title>
    <style>
        :root { --ink: #1d1b3a; --muted: #6e6c8a; --line: #e6e4f2; --bg: #f5f4fc; --brand: #5b4bdb; --brand-dark: #4638b8; --card: #ffffff; }
        * { box-sizing: border-box; }
        [hidden] { display: none !important; }
        body { margin: 0; font-family: system-ui, -apple-system, "Segoe UI", Roboto, sans-serif; background: var(--bg); color: var(--ink); }

        .hero { background: linear-gradient(135deg, #2e2490 0%, #5b4bdb 55%, #a24bf0 100%); color: #fff; padding: 22px 24px 96px; }
        .wrap { max-width: 1080px; margin: 0 auto; }
        .nav { display: flex; align-items: center; justify-content: space-between; gap: 12px; flex-wrap: wrap; }
        .marca { display: flex; align-items: center; gap: 10px; font-weight: 600; font-size: 18px; }
        .marca-logo { width: 36px; height: 36px; border-radius: 10px; background: rgba(255,255,255,.18); display: grid; place-items: center; font-size: 20px; }
        .usuario { display: flex; align-items: center; gap: 12px; font-size: 14px; }
        .avatar { width: 34px; height: 34px; border-radius: 50%; background: rgba(255,255,255,.22); display: grid; place-items: center; font-weight: 600; }
        .btn-salir { background: rgba(255,255,255,.16); color: #fff; border: 1px solid rgba(255,255,255,.35); border-radius: 10px; padding: 7px 14px; font-size: 13px; cursor: pointer; }
        .btn-salir:hover { background: rgba(255,255,255,.28); }
        .hero h1 { font-size: 34px; margin: 38px 0 6px; font-weight: 700; letter-spacing: -.5px; }
        .hero p { margin: 0; opacity: .85; font-size: 16px; max-width: 560px; }
        .pill { display: inline-block; margin-top: 16px; font-size: 12px; background: rgba(255,255,255,.18); padding: 5px 12px; border-radius: 999px; }
        .pill::before { content: ""; display: inline-block; width: 8px; height: 8px; border-radius: 50%; background: #4ade80; margin-right: 8px; }

        main { margin-top: -64px; padding: 0 24px 48px; }
        .stats { display: grid; grid-template-columns: repeat(auto-fit, minmax(160px, 1fr)); gap: 14px; }
        .stat { background: var(--card); border: 1px solid var(--line); border-radius: 16px; padding: 18px 20px; box-shadow: 0 8px 24px rgba(46,36,144,.08); }
        .stat b { display: block; font-size: 30px; line-height: 1.1; color: var(--brand); }
        .stat span { font-size: 13px; color: var(--muted); }

        .toolbar { display: flex; gap: 10px; flex-wrap: wrap; margin: 26px 0 18px; align-items: center; }
        .toolbar input, .toolbar select { font: inherit; font-size: 15px; padding: 11px 14px; border: 1px solid var(--line); border-radius: 12px; background: #fff; color: var(--ink); }
        .toolbar input { flex: 1; min-width: 200px; }
        .toolbar input:focus, .toolbar select:focus, dialog input:focus { outline: 2px solid var(--brand); outline-offset: 0; border-color: transparent; }
        .btn { font: inherit; font-size: 15px; font-weight: 600; border: none; border-radius: 12px; padding: 11px 18px; background: var(--brand); color: #fff; cursor: pointer; }
        .btn:hover { background: var(--brand-dark); }
        .btn.sec { background: #fff; color: var(--ink); border: 1px solid var(--line); }
        .btn.sec:hover { background: var(--bg); }
        .cuenta { font-size: 13px; color: var(--muted); margin: 0 0 14px; }

        .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(230px, 1fr)); gap: 18px; }
        .libro { background: var(--card); border: 1px solid var(--line); border-radius: 18px; overflow: hidden; display: flex; flex-direction: column; transition: transform .15s, box-shadow .15s; }
        .libro:hover { transform: translateY(-3px); box-shadow: 0 14px 30px rgba(46,36,144,.14); }
        .portada { height: 120px; display: grid; place-items: center; color: rgba(255,255,255,.95); font-size: 54px; font-weight: 700; position: relative; }
        .portada::after { content: ""; position: absolute; left: 14px; top: 0; bottom: 0; width: 8px; background: rgba(0,0,0,.14); }
        .c0 { background: linear-gradient(135deg, #5b4bdb, #8b5cf6); }
        .c1 { background: linear-gradient(135deg, #0ea5a4, #22c55e); }
        .c2 { background: linear-gradient(135deg, #f97316, #f43f5e); }
        .c3 { background: linear-gradient(135deg, #2563eb, #06b6d4); }
        .c4 { background: linear-gradient(135deg, #db2777, #a855f7); }
        .c5 { background: linear-gradient(135deg, #ca8a04, #ea580c); }
        .cuerpo { padding: 16px 16px 14px; display: flex; flex-direction: column; gap: 4px; flex: 1; }
        .cuerpo h3 { margin: 0; font-size: 17px; line-height: 1.25; }
        .autor { color: var(--muted); font-size: 14px; }
        .editorial { font-size: 13px; color: var(--muted); }
        .tags { display: flex; gap: 6px; flex-wrap: wrap; margin-top: 10px; }
        .tag { font-size: 12px; padding: 4px 10px; border-radius: 999px; background: #eeebff; color: var(--brand-dark); font-weight: 500; }
        .tag.col { background: #fff1e6; color: #b45309; }
        .pie { border-top: 1px solid var(--line); padding: 10px 16px; display: flex; justify-content: space-between; align-items: center; font-size: 12px; color: var(--muted); }
        .borrar { background: none; border: none; color: #c2410c; font-size: 13px; cursor: pointer; padding: 4px 6px; border-radius: 8px; }
        .borrar:hover { background: #fff1e6; }
        .vacio { text-align: center; color: var(--muted); padding: 48px 0; font-size: 16px; }

        dialog { border: none; border-radius: 20px; padding: 0; width: min(460px, 92vw); box-shadow: 0 30px 80px rgba(20,16,70,.35); }
        dialog::backdrop { background: rgba(20,16,70,.5); }
        .modal { padding: 26px; }
        .modal h2 { margin: 0 0 4px; font-size: 22px; }
        .modal p.sub { margin: 0 0 14px; color: var(--muted); font-size: 14px; }
        .modal label { display: block; font-size: 13px; color: var(--muted); margin: 12px 0 5px; }
        .modal input { width: 100%; font: inherit; font-size: 15px; padding: 10px 12px; border: 1px solid var(--line); border-radius: 10px; }
        .acc { display: flex; justify-content: flex-end; gap: 10px; margin-top: 22px; }
        .err { background: #fdeceb; color: #a32d2d; font-size: 13px; padding: 10px 12px; border-radius: 10px; margin-top: 12px; }
        footer { text-align: center; color: var(--muted); font-size: 12px; padding-bottom: 28px; }
    </style>
</head>
<body>
    <header class="hero">
        <div class="wrap">
            <div class="nav">
                <div class="marca"><span class="marca-logo">&#128214;</span> Biblioteca</div>
                <div class="usuario">
                    <span class="avatar">{{ mb_strtoupper(mb_substr(auth()->user()->name, 0, 1)) }}</span>
                    <span>{{ auth()->user()->name }}</span>
                    <form method="POST" action="/logout" style="margin: 0;">
                        @csrf
                        <button type="submit" class="btn-salir">Salir</button>
                    </form>
                </div>
            </div>
            <h1>Catálogo de libros</h1>
            <p>Consulta, agrega y administra tu colección. Esta página consume la API REST del proyecto.</p>
            <span class="pill">API activa &middot; /api/v1/libros</span>
        </div>
    </header>

    <main>
        <div class="wrap">
            <section class="stats">
                <div class="stat"><b>{{ count($libros) }}</b><span>Libros</span></div>
                <div class="stat"><b>{{ $totalAutores }}</b><span>Autores</span></div>
                <div class="stat"><b>{{ count($idiomas) }}</b><span>Idiomas</span></div>
                <div class="stat"><b>{{ $totalColecciones }}</b><span>Colecciones</span></div>
            </section>

            <div class="toolbar">
                <input id="q" type="search" placeholder="Buscar por título, autor, editorial o colección">
                <select id="idioma">
                    <option value="">Todos los idiomas</option>
                    @foreach ($idiomas as $idioma)
                        <option value="{{ $idioma }}">{{ $idioma }}</option>
                    @endforeach
                </select>
                <button class="btn" id="nuevo" type="button">+ Nuevo libro</button>
            </div>
            <p class="cuenta">Mostrando <b id="contador">{{ count($libros) }}</b> de {{ count($libros) }} libros</p>

            <section class="grid" id="grid">
                @foreach ($libros as $libro)
                    <article class="libro" data-id="{{ $libro->id }}" data-titulo="{{ $libro->titulo }}" data-idioma="{{ $libro->idioma }}" data-buscar="{{ mb_strtolower($libro->titulo . ' ' . $libro->autor . ' ' . $libro->editorial . ' ' . $libro->coleccion) }}">
                        <div class="portada c{{ $libro->id % 6 }}">{{ mb_strtoupper(mb_substr($libro->titulo, 0, 1)) }}</div>
                        <div class="cuerpo">
                            <h3>{{ $libro->titulo }}</h3>
                            <span class="autor">{{ $libro->autor }}</span>
                            <span class="editorial">{{ $libro->editorial }}</span>
                            <div class="tags">
                                <span class="tag">{{ $libro->idioma }}</span>
                                @if ($libro->coleccion)
                                    <span class="tag col">{{ $libro->coleccion }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="pie">
                            <span>ID {{ $libro->id }}</span>
                            <button type="button" class="borrar">Eliminar</button>
                        </div>
                    </article>
                @endforeach
            </section>

            <p class="vacio" id="vacio" @if (count($libros) > 0) hidden @endif>No hay libros que coincidan. Prueba con otra búsqueda o agrega uno nuevo.</p>
        </div>
    </main>

    <footer>Proyecto U3 &middot; Laravel + Eloquent ORM + MySQL</footer>

    <dialog id="modal">
        <form class="modal" id="form" method="dialog">
            <h2>Nuevo libro</h2>
            <p class="sub">Se guardará mediante POST /api/v1/libros</p>
            <label for="f-titulo">Título</label>
            <input id="f-titulo" name="titulo" required maxlength="255">
            <label for="f-autor">Autor</label>
            <input id="f-autor" name="autor" required maxlength="255">
            <label for="f-editorial">Editorial</label>
            <input id="f-editorial" name="editorial" required maxlength="255">
            <label for="f-idioma">Idioma</label>
            <input id="f-idioma" name="idioma" required maxlength="100" placeholder="Español">
            <label for="f-coleccion">Colección o serie (opcional)</label>
            <input id="f-coleccion" name="coleccion" maxlength="255">
            <div class="err" id="errores" hidden></div>
            <div class="acc">
                <button type="button" class="btn sec" id="cancelar">Cancelar</button>
                <button type="submit" class="btn" id="guardar">Guardar libro</button>
            </div>
        </form>
    </dialog>

    <script>
        var q = document.getElementById('q');
        var sel = document.getElementById('idioma');
        var tarjetas = Array.prototype.slice.call(document.querySelectorAll('.libro'));
        var contador = document.getElementById('contador');
        var vacio = document.getElementById('vacio');

        function filtrar() {
            var t = q.value.trim().toLowerCase();
            var n = 0;
            tarjetas.forEach(function (c) {
                var ok = (!t || c.dataset.buscar.indexOf(t) !== -1) && (!sel.value || c.dataset.idioma === sel.value);
                c.hidden = !ok;
                if (ok) { n++; }
            });
            contador.textContent = n;
            vacio.hidden = n !== 0;
        }
        q.addEventListener('input', filtrar);
        sel.addEventListener('change', filtrar);

        var modal = document.getElementById('modal');
        var form = document.getElementById('form');
        var errores = document.getElementById('errores');
        document.getElementById('nuevo').addEventListener('click', function () {
            form.reset();
            errores.hidden = true;
            modal.showModal();
        });
        document.getElementById('cancelar').addEventListener('click', function () { modal.close(); });

        form.addEventListener('submit', function (e) {
            e.preventDefault();
            var datos = {};
            new FormData(form).forEach(function (v, k) { datos[k] = v === '' ? null : v; });
            errores.hidden = true;
            fetch('/api/v1/libros', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                body: JSON.stringify(datos)
            }).then(function (r) {
                return r.json().then(function (j) { return { status: r.status, body: j }; });
            }).then(function (res) {
                if (res.status === 201) { window.location.reload(); return; }
                var msgs = [];
                if (res.body.errors) {
                    Object.keys(res.body.errors).forEach(function (k) { msgs = msgs.concat(res.body.errors[k]); });
                } else {
                    msgs.push(res.body.message || 'No se pudo guardar el libro.');
                }
                errores.textContent = msgs.join(' ');
                errores.hidden = false;
            }).catch(function () {
                errores.textContent = 'No se pudo conectar con la API.';
                errores.hidden = false;
            });
        });

        document.getElementById('grid').addEventListener('click', function (e) {
            if (!e.target.classList.contains('borrar')) { return; }
            var c = e.target.closest('.libro');
            if (!confirm('¿Eliminar "' + c.dataset.titulo + '"?')) { return; }
            fetch('/api/v1/libros/' + c.dataset.id, { method: 'DELETE', headers: { 'Accept': 'application/json' } })
                .then(function (r) {
                    if (r.ok) { window.location.reload(); } else { alert('No se pudo eliminar el libro.'); }
                })
                .catch(function () { alert('No se pudo conectar con la API.'); });
        });
    </script>
</body>
</html>
