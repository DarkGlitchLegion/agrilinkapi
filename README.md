# AgriLink API

Laravel API for connecting farmers and buyers through farm listings, inquiries, quotations, and orders.

## API groups

| Prefix | Resources |
| --- | --- |
| `/api/auth` | Register, login, logout |
| `/api/buyers` | Buyer and business profiles, requirements, members |
| `/api/commerce` | Conversations, inquiries, quotations, orders, reviews |
| `/api/geography` | Provinces, municipalities, barangays, farms |
| `/api/identity` | Roles, permissions, addresses, preferences, verification |
| `/api/knowledge` | Articles, categories, assistance programs |
| `/api/market-intelligence` | Markets, sources, prices, imports, alerts |
| `/api/notifications` | Notification preferences and deliveries |
| `/api/products` | Commodities, listings, categories, images, saved listings |

Registration and login are public. All other API routes require a Sanctum bearer token:

```http
Authorization: Bearer <token>
Accept: application/json
```

## Authentication flow

```mermaid
flowchart LR
    Client[API client] --> Auth{Register or login}
    Auth -->|Valid| Token[Return user and token]
    Auth -->|Invalid| Error[Return validation error]
    Token --> Request[Call protected endpoint with bearer token]
    Request --> Check{Sanctum token valid?}
    Check -->|No| Unauthorized[401 Unauthorized]
    Check -->|Yes| API[Run API action]
    API --> Response[Return JSON response]
    Response --> Client
    Client -->|Logout with token| Revoke[Revoke current token]
```

## Data flow diagram

```mermaid
flowchart LR
    Farmer[Farmer] <--> API((AgriLink API))
    Buyer[Buyer] <--> API
    Admin[Administrator] <--> API
    MarketSource[Market data source] --> API

    API <--> Identity[(Users and access)]
    API <--> Farms[(Farms and geography)]
    API <--> Products[(Commodities and listings)]
    API <--> Commerce[(Inquiries, quotations, orders)]
    API <--> Market[(Markets and price data)]
    API <--> Content[(Knowledge and notifications)]
```

## Entity relationship diagram

Core business relationships from the database migrations. The migrations define the complete schema, including supporting tables and fields.

```mermaid
erDiagram
    USERS {
        bigint id PK
        string name
        string email
    }
    PROVINCES {
        bigint id PK
    }
    MUNICIPALITIES {
        bigint id PK
        bigint province_id FK
    }
    BARANGAYS {
        bigint id PK
        bigint municipality_id FK
    }
    FARMS {
        bigint id PK
        bigint owner_user_id FK
        bigint barangay_id FK
    }
    COMMODITIES {
        bigint id PK
        bigint category_id FK
    }
    PRODUCT_LISTINGS {
        bigint id PK
        bigint farm_id FK
        bigint commodity_id FK
    }
    BUYER_PROFILES {
        bigint id PK
        bigint user_id FK
    }
    BUYER_PRODUCT_REQUIREMENTS {
        bigint id PK
        bigint buyer_profile_id FK
        bigint commodity_id FK
    }
    INQUIRIES {
        bigint id PK
        bigint buyer_user_id FK
        bigint product_listing_id FK
    }
    QUOTATIONS {
        bigint id PK
        bigint inquiry_id FK
        bigint farmer_user_id FK
    }
    ORDERS {
        bigint id PK
        bigint buyer_user_id FK
        bigint farmer_user_id FK
        bigint quotation_id FK
    }
    ORDER_ITEMS {
        bigint id PK
        bigint order_id FK
        bigint product_listing_id FK
    }
    MARKETS {
        bigint id PK
        bigint barangay_id FK
    }
    DATA_SOURCES {
        bigint id PK
    }
    MARKET_PRICE_OBSERVATIONS {
        bigint id PK
        bigint commodity_id FK
        bigint market_id FK
        bigint source_id FK
    }
    KNOWLEDGE_CATEGORIES {
        bigint id PK
    }
    KNOWLEDGE_ARTICLES {
        bigint id PK
        bigint category_id FK
        bigint author_user_id FK
    }

    PROVINCES ||--o{ MUNICIPALITIES : contains
    MUNICIPALITIES ||--o{ BARANGAYS : contains
    BARANGAYS ||--o{ FARMS : locates
    USERS ||--o{ FARMS : owns
    FARMS ||--o{ PRODUCT_LISTINGS : offers
    COMMODITIES ||--o{ PRODUCT_LISTINGS : describes
    USERS ||--o{ BUYER_PROFILES : has
    BUYER_PROFILES ||--o{ BUYER_PRODUCT_REQUIREMENTS : defines
    COMMODITIES ||--o{ BUYER_PRODUCT_REQUIREMENTS : requested
    USERS ||--o{ INQUIRIES : submits
    PRODUCT_LISTINGS ||--o{ INQUIRIES : receives
    INQUIRIES ||--o{ QUOTATIONS : receives
    USERS ||--o{ QUOTATIONS : offers
    USERS ||--o{ ORDERS : buys
    USERS ||--o{ ORDERS : fulfills
    QUOTATIONS o|--o{ ORDERS : may_create
    ORDERS ||--o{ ORDER_ITEMS : contains
    PRODUCT_LISTINGS ||--o{ ORDER_ITEMS : fulfills
    BARANGAYS ||--o{ MARKETS : locates
    MARKETS ||--o{ MARKET_PRICE_OBSERVATIONS : records
    COMMODITIES ||--o{ MARKET_PRICE_OBSERVATIONS : priced
    DATA_SOURCES ||--o{ MARKET_PRICE_OBSERVATIONS : supplies
    KNOWLEDGE_CATEGORIES ||--o{ KNOWLEDGE_ARTICLES : groups
    USERS ||--o{ KNOWLEDGE_ARTICLES : authors
```
