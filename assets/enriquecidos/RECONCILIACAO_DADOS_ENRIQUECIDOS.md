# Artifact Reconciliation And Enrichment Report

Generated at: 2026-07-08T18:57:10.757Z

## Scope

This report covers local enrichment only. No file inside `public-pacote_hackathon-20260706` was edited by the generation script.

## Generated Files

- `data/enrichment/carros_catalogo.enriched.json`: structured enriched dataset for app seed/RAG planning.
- `data/enrichment/rag-knowledge-base.enriched.md`: markdown corpus suitable for later PDF generation or chunking.
- `data/enrichment/sources.firecrawl.json`: source coverage and local scratch pointers.
- `data/enrichment/reconciliation-report.md`: this report.

## Reconciliation Decisions

- Package JSON remains canonical for challenge prices and specs.
- Firecrawl official pages enrich context, recommendations, search terms, technology/safety descriptions and trade-offs.
- Current official pages may show 2027 or 2026/2027 lines for Chevrolet/Hyundai/BYD. These observations are stored but do not override package values.
- Dense RAG should index both the original PDF and this enriched markdown, with metadata differentiating `package` vs `external_enrichment`.

## Data Quality Findings Still Worth Fixing In The Drive Package

- `assets/imagens/images.jpeg` is not referenced by the JSON catalog.
- `CREDITOS_FOTOS.csv` is missing rows for `toyota_corolla_cross*.jpg` and `hyundai_hb20s*.jpg` images.
- CSV field `imagens_extras` stores only extra images while JSON `imagens` stores main image plus extras; this is acceptable if documented, but confusing for candidates.
- BYD categories mix body type and fuel type (`Hatch elétrico`, `SUV elétrico`, `Sedan elétrico`). The enriched dataset splits `body_type` and `fuel_type`.
- Firecrawl parsing of the original PDF produced duplicated/out-of-order FAQ text in some places. Prefer the original PDF or a regenerated enriched markdown for future chunking.

## Source Coverage

- Toyota Corolla: https://www.toyota.com.br/modelos/corolla (2026)
- Toyota Corolla Cross: https://www.toyota.com.br/modelos/corolla-cross (2027)
- Toyota Hilux: https://www.toyota.com.br/modelos/hilux-cabine-dupla (2026)
- Volkswagen Polo: https://www.vw.com.br/pt/carros/polo.html (current)
- Volkswagen Virtus: https://www.vw.com.br/pt/carros/virtus.html (current)
- Volkswagen T-Cross: https://www.vw.com.br/pt/carros/t-cross.html (current)
- Chevrolet Onix: https://www.chevrolet.com.br/carros/novo-onix (2027)
- Chevrolet Tracker: https://www.chevrolet.com.br/suvs/novo-tracker (2027)
- Chevrolet Montana: https://www.chevrolet.com.br/picapes/chevrolet-montana (2027)
- Hyundai HB20: https://www.hyundai.com.br/veiculos/novo-hyundai-hb20.html (2026/2027)
- Hyundai HB20S: https://www.hyundai.com.br/veiculos/novo-hyundai-hb20s.html (2026/2027)
- Hyundai Creta: https://www.hyundai.com.br/veiculos/novo-hyundai-creta.html (2026/2027)
- BYD Dolphin: https://www.byd.com/br/car/dolphin (current)
- BYD Yuan Plus: https://www.byd.com/br/car/yuan-plus (current)
- BYD Seal: https://www.byd.com/br/car/seal (current)

## Suggested Next Step

Use the enriched artifacts alongside the original package files during the hackathon. The original JSON/CSV/PDF remain valid baseline references; the enriched JSON/CSV/Markdown/DOCX files are the curated reference used by the demo implementation.
