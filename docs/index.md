# ComuniBundle

With this bundle for Symfony, it is possible to load the updated list produced by Garda Informatica that provides useful data for managing Italian municipalities.

In particular:

- **codice_istat**: ISTAT code of the municipality, a unique identifier assigned by the National Institute of Statistics (ISTAT) for each Italian municipality.
- **denominazione_ita_altra**: Name of the municipality in Italian, possibly with other official or historical names.
- **denominazione_ita**: Official name of the municipality in Italian.
- **denominazione_altra**: Name of the municipality in other languages or dialects, if applicable.
- **cap**: Postal Code (CAP) of the municipality.
- **sigla_provincia**: Abbreviation of the province to which the municipality belongs.
- **denominazione_provincia**: Name of the province to which the municipality belongs.
- **tipologia_provincia**: Type of province, such as "Metropolitan City" or "Province".
- **codice_regione**: Code of the region to which the municipality belongs.
- **denominazione_regione**: Name of the region to which the municipality belongs.
- **tipologia_regione**: Type of region, such as "Ordinary Statute" or "Special Statute".
- **ripartizione_geografica**: Geographical division of Italy in which the municipality is located, such as "North-west", "North-east", "Center", "South", "Islands".
- **flag_capoluogo**: Indicator if the municipality is a provincial capital or not. Possible values: "YES" or "NO".
- **codice_belfiore**: Belfiore code, an alphanumeric code used to identify Italian municipalities in some administrative contexts.
- **lat**: Geographical latitude of the municipality.
- **lon**: Geographical longitude of the municipality.
- **superficie_kmq**: Area of the municipality in square kilometers (km²).

The data is loaded into a specific table in the database.

Through the service `Metarete\ComuniBundle\Service`, it is then possible to have useful commands to manage this data.

## Link

[Garda Informatica](https://www.gardainformatica.it/)

## Credits

[Metarete s.r.l.](https://metarete.it)
