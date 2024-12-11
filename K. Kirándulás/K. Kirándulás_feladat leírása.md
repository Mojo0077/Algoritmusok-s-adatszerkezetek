# Kirándulás sorrend

Egy városok közötti turistaútvonalat szeretnénk optimalizálni, hogy minimális utazási idővel járjuk be az összes várost. Minden város között buszjáratok közlekednek, és adott az utazás ideje. A cél az, hogy meghatározzuk, milyen sorrendben kell meglátogatni az összes várost (az indulási város kivételével), hogy az utazási idő minimális legyen.

## Bemenet
A bemeneti fájl első sora három számot tartalmaz:
- N: a városok száma (1 ≤ N ≤ 10).
- M: az utak száma (1 ≤ M ≤ N×(N-1)/2, tehát teljes gráf esetén legfeljebb N*(N-1)/2).
- S: a kezdőváros sorszáma (1 ≤ S ≤ N).

A következő M sor mindegyike három egész számot tartalmaz:

- a, b, t, ahol:
  - a és b az összekötött városok sorszáma (1 ≤ a, b ≤ N, a ≠ b),
  - t az út hossza a két város között (1 ≤ t ≤ 10,000).

Az utak iránynélküliek, vagyis ha az egyik sorban szerepel az a b t kapcsolat, akkor az út mindkét irányban járható ugyanannyi idő alatt.

## Kimenet
- Az első sor a minimális utazási időt tartalmazza.
- A második sor a városok bejárási sorrendjét adja meg.

## Példa

### Bemenet
`7 8 1`

`1 2 1` 

`1 3 5` 

`2 3 1`

`2 7 3`

`3 4 6`

`4 5 2`

`4 6 2`

`5 6 2`


### Kimenet
`22`

`2 3 7 4 6 5`


## Korlátok
- Időlimit: 0.4 mp.
- Memória: 32 MB.
