# CLAUDE.md

## Zacznij tutaj

Na początku każdej sesji przeczytaj `docs/zacznij-tutaj.md` — stan prac, ustalenia, otwarte kwestie i następny krok. Katalog `docs/` istnieje tylko lokalnie (nie ma go w repo).

## Zasady pracy ustalone w projekcie

- **Commit i push:** zawsze pytaj przed każdym `git commit` i każdym `git push`, osobno. Wcześniejsza zgoda nie obejmuje kolejnych zmian.
- **Repo jest publiczne.** Dane wrażliwe (dokumentacja z treściami i decyzjami klientki, dane dostępowe, `docker-compose.yml`) zostają lokalnie i są w `.gitignore`. Przed commitem sprawdź staged pliki.
- **Priorytet ustaleń:** `docs/07-client-questions.md` > korespondencja z klientką > makieta HTML.
- **Wzorzec wyglądu:** `html_design/` (poprawiona makieta). `html_design-original/` to oryginał tylko do porównań — nie edytować.
- **Po zmianach w `html_design/`** uruchom test RWD z `docs/narzedzia/check-rwd.py` (brak poziomego scrolla i przyciętych napisów na 320–1920 px).
- **Wdrożenie:** Docker lokalnie → git → FTP na staging → przeniesienie na serwer klientki. Struktura (szablony, patterny, `theme.json`, pola ACF) tylko w plikach; nie edytujemy szablonów w Edytorze witryny, bo zmiana zapisuje się w bazie i nie przechodzi przez FTP.
- **Wtyczki zewnętrzne** nie są wersjonowane — instalowane z panelu na każdym środowisku. W repo z `wp-content` są tylko `themes/qbatura` i `plugins/qbatura-core`.
- **Aktywacja motywu i wtyczek** w kontenerze — zapytaj przed zmianą.

## Rola Claude w projekcie

Jesteś asystentem programistycznym pracującym nad stroną WordPress na podstawie istniejącej płaskiej wersji HTML znajdującej się w katalogu:

```txt
html_design

Twoim zadaniem jest:

Przeanalizować istniejącą wersję HTML/CSS/JS.

Zachować jej wygląd, animacje, charakter wizualny i ogólne doświadczenie użytkownika.

Naprawić oczywiste błędy techniczne, semantyczne i RWD obecne w wersji HTML.

Przygotować architekturę strony pod nowoczesny WordPress.

Zbudować motyw blokowy WordPress zgodny z Full Site Editing.

Wykorzystać możliwie natywne mechanizmy WordPress/Gutenberg.

Nie zastępować projektu przypadkowym gotowym motywem ani builderem.

Nie wymyślać finalnych treści za klientkę — treści są placeholderami do momentu dostarczenia contentu.

Docelowy motyw ma powstać w katalogu:

txt

Apply ...
wp-content/themes/qbatura

Jeżeli katalog jeszcze nie istnieje, należy go utworzyć.

Kontekst projektu

W katalogu html_design znajduje się płaska wersja strony WWW. Jest to aktualnie wizualny wzorzec projektu. Należy traktować ją jako referencję designu.

HTML może zawierać niedoskonałości, np.:

błędy semantyczne,

brak pełnej dostępności,

niepełne RWD,

powtarzalny kod,

treści tymczasowe,

nieoptymalne assety,

niespójności w strukturze,

elementy trudne do bezpośredniego przeniesienia do WordPressa.

CSS i JS z wersji HTML są ważne, ponieważ definiują styl, animacje i charakter strony. Nie należy ich pochopnie usuwać ani upraszczać, jeżeli wpływają na odbiór wizualny.

Główna zasada wizualna

Motyw WordPress ma wyglądać możliwie identycznie jak wersja HTML.

Dopuszczalne są poprawki, jeżeli:

poprawiają responsywność,

poprawiają dostępność,

poprawiają semantykę,

poprawiają wydajność,

naprawiają oczywiste błędy,

nie zmieniają charakteru wizualnego projektu,

nie zmieniają intencji layoutu.

Niedopuszczalne jest:

zmienianie stylu na „bardziej wordpressowy”,

zastępowanie designu domyślnymi blokami bez stylizacji,

używanie losowych wzorców z gotowych motywów,

nadmierne upraszczanie animacji,

wprowadzanie nowej identyfikacji wizualnej bez zgody.

Standard WordPress

Strona ma być zbudowana jako nowoczesny motyw blokowy WordPress.

Punktem odniesienia jest aktualny oficjalny standard WordPress Full Site Editing, podobny architektonicznie do motywu Twenty Twenty-Five.

Preferowane podejście:

motyw blokowy FSE,

theme.json,

szablony blokowe .html,

części szablonów w parts,

wzorce blokowe w patterns,

style globalne przez theme.json,

natywne bloki Gutenberg,

własne style bloków, jeżeli wystarczą,

własne patterny dla sekcji,

minimalna ilość niestandardowego PHP,

minimalna ilość JavaScriptu, tylko tam gdzie potrzebna.

Nie należy używać klasycznych page builderów typu Elementor, WPBakery itp.

Inspiracje i istniejące zasoby

W projekcie może istnieć katalog:

txt

Apply ...
wp-content/themes/reikiflow

oraz powiązane pluginy w:

txt

Apply ...
wp-content/plugins

Należy je przeanalizować jako możliwe źródło inspiracji architektonicznej, ale nie kopiować bezmyślnie.

Można z nich wykorzystać:

sposób organizacji motywu,

dobre praktyki,

strukturę assetów,

przykłady patternów,

konfiguracje theme.json,

rozwiązania dla własnych bloków lub styli bloków,

rozwiązania build/deploy, jeśli istnieją.

Nie wolno przenosić kodu, który:

jest specyficzny dla poprzedniej strony,

zawiera inne treści/branding,

ma zależności niepotrzebne w tym projekcie,

wprowadza chaos architektoniczny,

pogarsza prostotę motywu.

Etapy pracy

Etap 1 — Audyt wersji HTML

Przeanalizuj katalog html_design.

Ustal:

jakie są podstrony,

jakie sekcje powtarzają się na stronie,

jak wygląda nagłówek,

jak wygląda stopka,

jakie są komponenty UI,

jakie animacje występują,

jakie fonty są użyte,

jakie kolory są użyte,

jakie breakpoints występują lub powinny występować,

jakie assety są potrzebne,

które treści są placeholderami,

które elementy powinny być edytowalne z poziomu WordPressa,

które elementy mogą być stałe w motywie,

które części HTML wymagają napraw RWD,

które elementy wymagają poprawy dostępności.

Wyniki zapisz w:

txt

Apply ...
docs/05-html-design-audit.md

Jeżeli plik nie istnieje, utwórz go.

Etap 2 — Ustalenie architektury WordPress

Na podstawie audytu HTML zdecyduj:

jakie typy treści są potrzebne,

jakie template’y WordPress są potrzebne,

jakie template parts są potrzebne,

jakie patterny blokowe są potrzebne,

czy potrzebne są custom post types,

czy potrzebne są custom taxonomies,

czy potrzebne są custom fields,

czy wystarczą natywne bloki i patterny,

czy potrzebne są custom bloki,

czy elementy interaktywne wymagają osobnego JS,

czy funkcjonalności powinny być w motywie czy w pluginie.

Wnioski zapisz w:

txt

Apply ...
docs/04-wordpress-architecture.md

Etap 3 — Przygotowanie motywu qbatura

Utwórz motyw blokowy w:

txt

Apply ...
wp-content/themes/qbatura

Minimalna struktura motywu:

txt

Apply ...
wp-content/themes/qbatura/
  style.css
  theme.json
  functions.php
  templates/
    index.html
    front-page.html
    page.html
    single.html
    archive.html
    404.html
  parts/
    header.html
    footer.html
  patterns/
  assets/
    css/
    js/
    images/
    fonts/
  inc/

Struktura może zostać rozszerzona, jeżeli będzie to uzasadnione.

Etap 4 — Odwzorowanie designu

Przenieś design z html_design do motywu WordPress.

Zachowaj:

układ sekcji,

proporcje,

typografię,

kolory,

marginesy,

rytm wizualny,

animacje,

hover states,

wygląd menu,

wygląd przycisków,

charakter hero section,

wygląd stopki,

responsywność po naprawach.

Etap 5 — Edytowalność w WordPress

Strona ma być wygodna do edycji.

Preferowane mechanizmy:

block patterns,

template parts,

reusable sections,

natywne bloki,

style bloków,

global styles,

theme.json.

Elementy takie jak teksty, nagłówki, zdjęcia, CTA i listy powinny być możliwie edytowalne z poziomu edytora WordPress, o ile nie narusza to sensownej architektury.

Co Claude może samodzielnie zdecydować

Możesz samodzielnie decydować o:

nazwach klas CSS,

strukturze plików w motywie,

refaktoryzacji CSS,

poprawkach RWD,

poprawkach semantycznych HTML,

podziale sekcji na patterny,

tym, czy element powinien być patternem czy częścią template’u,

drobnych korektach spacingu dla responsywności,

optymalizacji assetów,

dostosowaniu kodu do standardów WordPress,

poprawkach dostępności,

wyborze natywnych bloków Gutenberg tam, gdzie wystarczają,

dodaniu niewielkiego JS dla animacji/interakcji,

usunięciu martwego kodu,

uporządkowaniu placeholderów.

Każdą większą decyzję architektoniczną zapisz w:

txt

Apply ...
docs/06-decisions-log.md

O czym Claude nie powinien decydować samodzielnie

Nie decyduj samodzielnie o:

finalnych treściach marketingowych,

finalnych zdjęciach klientki,

ofercie,

cenniku,

danych kontaktowych,

danych prawnych,

polityce prywatności,

regulaminie,

claimach sprzedażowych,

zmianie nazwy marki,

zmianie identyfikacji wizualnej,

dodaniu nowych podstron biznesowych bez potrzeby,

radykalnej zmianie układu wizualnego,

wyborze płatnych pluginów,

integracjach z zewnętrznymi usługami.

Takie kwestie zapisuj jako pytania w:

txt

Apply ...
docs/07-client-questions.md

Treści i placeholdery

Aktualne treści w html_design należy traktować jako robocze, chyba że wyraźnie wynika inaczej.

Nie wymyślaj finalnego contentu.

Możesz używać neutralnych placeholderów, np.:

„Nagłówek sekcji do uzupełnienia”

„Opis zostanie dostarczony przez klientkę”

„Tekst CTA do potwierdzenia”

„Zdjęcie docelowe do podmiany”

Jeżeli HTML zawiera konkretne teksty, które wyglądają jak prawdziwy content, oznacz je w audycie jako „do potwierdzenia”.

Wymagania dotyczące dostępności

Przy przenoszeniu designu do WordPress zadbaj o:

semantyczne nagłówki,

jeden logiczny h1 na stronie,

poprawne alt dla obrazów,

aria-label dla ikon/przycisków bez tekstu,

focus states,

dostępność menu z klawiatury,

odpowiedni kontrast,

brak treści dostępnych wyłącznie przez hover,

poprawne linki i przyciski,

unikanie pustych linków,

poszanowanie prefers-reduced-motion.

Animacje powinny być wyłączane lub ograniczane dla użytkowników z prefers-reduced-motion: reduce.

Wymagania RWD

Napraw RWD tam, gdzie wersja HTML ma luki.

Minimum należy sprawdzić:

320 px,

360 px,

390 px,

430 px,

768 px,

1024 px,

1280 px,

1440 px,

1920 px.

Zwróć uwagę na:

menu mobilne,

hero section,

nachodzące teksty,

zbyt duże fonty na mobile,

overflow poziomy,

przyciski wychodzące poza ekran,

obrazy bez proporcji,

układ kart,

spacing sekcji,

stopkę,

animacje na mobile.

Wydajność

Dbaj o:

ograniczenie liczby fontów i wag,

lokalne ładowanie fontów, jeśli są dostępne,

optymalizację obrazów,

lazy loading obrazów,

brak zbędnych bibliotek JS,

brak duplikacji CSS,

minimalne zależności,

wykorzystanie natywnych możliwości WordPress.

Nie dodawaj dużych bibliotek tylko dla prostych animacji.

Bloki, patterny i custom bloki

Najpierw sprawdź, czy projekt można odwzorować za pomocą:

core/group,

core/columns,

core/cover,

core/image,

core/media-text,

core/buttons,

core/query,

core/post-template,

core/navigation,

core/template-part,

własnych klas CSS,

własnych patternów.

Custom block twórz tylko wtedy, gdy:

natywne bloki są niewystarczające,

element ma skomplikowaną strukturę,

element będzie wielokrotnie używany,

edycja przez zwykłe bloki byłaby zbyt podatna na błędy,

komponent wymaga specyficznej logiki lub interakcji.

Jeżeli custom block jest potrzebny, uzasadnij to w docs/04-wordpress-architecture.md.

Funkcjonalności niezwiązane bezpośrednio z wyglądem lepiej umieszczać w pluginie, a nie w motywie.

Konwencje kodu

Stosuj:

standardy WordPress Coding Standards,

czytelne nazwy klas,

prefiks projektu qbatura,

semantyczny HTML,

modularny CSS,

komentarze tam, gdzie pomagają,

bezpieczne funkcje WordPress w PHP,

escapowanie danych w PHP,

brak inline JS, jeśli nie jest konieczny.

Nie usuwaj istniejących komentarzy bez powodu.

Nie upraszczaj kodu kosztem czytelności.

Nie mieszaj logiki biznesowej z warstwą prezentacji.

Dokumentowanie zmian

Po większych zmianach aktualizuj:

txt

Apply ...
docs/06-decisions-log.md

Wpis powinien zawierać:

datę,

decyzję,

powód,

alternatywy,

konsekwencje.

Przed zakończeniem pracy sprawdź

Czy motyw aktywuje się w WordPress?

Czy nie ma błędów PHP?

Czy theme.json jest poprawny?

Czy szablony FSE działają?

Czy front page odpowiada wersji HTML?

Czy header i footer są edytowalne?

Czy style działają w edytorze i na froncie?

Czy RWD jest poprawione?

Czy nie ma poziomego scrolla?

Czy animacje działają?

Czy prefers-reduced-motion jest obsłużone?

Czy placeholdery są oznaczone?

Czy pytania do klientki są zapisane?

Czy decyzje architektoniczne są zapisane?

Najważniejszy cel

Efektem końcowym ma być nowoczesny, edytowalny motyw WordPress FSE qbatura, który wizualnie odpowiada płaskiej wersji HTML, ale jest technicznie poprawniejszy, responsywny, dostępny i gotowy do uzupełnienia prawdziwymi treściami klientki.

Apply ...

---

# `docs/01-project-brief.md`

```md
# Project brief — Qbatura

## Cel projektu

Celem projektu jest stworzenie nowoczesnej strony WordPress na podstawie istniejącej płaskiej wersji HTML.

Wersja HTML znajduje się w:

```txt
html_design

Docelowy motyw WordPress ma powstać w:

txt

Apply ...
wp-content/themes/qbatura

Charakter pracy

Projekt dzieli się na dwa główne etapy:

Analiza i uporządkowanie istniejącej wersji HTML.

Budowa motywu WordPress FSE odwzorowującego design.

Status treści

Treści w obecnej wersji HTML nie są finalne.

Finalny content ma zostać dostarczony przez klientkę.

Do tego czasu należy stosować placeholdery i oznaczać treści wymagające potwierdzenia.

Priorytety

Wierność względem projektu HTML.

Poprawna responsywność.

Nowoczesna architektura WordPress FSE.

Łatwa edycja przez klientkę.

Minimalna liczba zależności.

Dobra wydajność.

Dostępność.