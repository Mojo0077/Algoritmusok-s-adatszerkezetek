# Kirándulás sorrend - Megoldás

## Megoldás áttekintése

A feladat a minimális körút problémájának egyszerűbb változata, amely minden várost pontosan egyszer érintve, a kezdővárosba visszatérve keresi a legrövidebb utat. A megoldás során a következő lépéseket követjük:
1. **Adatok beolvasása**: 
- A bemenet alapján létrehozzuk a városok gráfreprezentációját.
2. **Körút meghatározás**: 
- Egy algoritmus, például a Dijkstra vagy egyedi implementáció, segítségével meghatározzuk a minimális utazási időt.
3. **Legjobb út kiválasztása**: 
- A generált sorrendek közül kiválasztjuk azt, amelynek az összhossza minimális.

## Használt adatszerkezetek
- **Gráf szomszédsági lista formájában**: A városok közötti kapcsolatok és utak tárolására.
- **Permutációk listája**: A városok sorrendjeinek generálására.
- **Egyszerű változók**: Az aktuális és a minimális megtalált körút tárolására.

## Algoritmus
Algoritmus
1. **Bemenet feldolgozása**:

- A bemeneti fájlból olvassuk be a városok számát (N), az utak számát (M), és a kezdővárost (S).
- Építsük fel a gráfot szomszédsági lista formájában.
2. **Körút meghatározása**:

- Használjuk a városok listáját az összes lehetséges sorrend generálásához (permute algoritmus).
- Minden sorrendre számítsuk ki az út hosszát, és ellenőrizzük, hogy az élek léteznek-e.
3. **Legjobb körút kiválasztása**:

- A generált körutak közül válasszuk ki a legrövidebb összhosszúságút.
- Jegyezzük meg a sorrendet is, amely ezt az időt adja.
4. **Eredmény kiírása**:

- A legrövidebb út hosszát és a sorrendet írjuk ki egy fájlba.

## Bonyolultság
- **Időbonyolultság**:
  - Gráf építése:O(M), ahol M az utak száma.
  - Permutációk generálása:O(N!), ahol N a városok száma.
  - Út hosszának kiszámítása permutációnként:O(N).
  - Összesen: O(N!⋅N), ami 10 város esetén kezelhető.
- **Memóriabonyolultság**: 
  - Gráf tárolása: O(M), ahol M az utak száma.
  - Permutációk és változók tárolása: O(N!), ami kis méretnél nem probléma.