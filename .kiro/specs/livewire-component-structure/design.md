# Design Document - Livewire Component Structure

## Overview

Project ini menggunakan Livewire untuk membangun interface yang reactive. Component diorganisir berdasarkan role (Admin, Peserta, Qualifier) dan fitur untuk memudahkan maintenance dan scalability.

## Architecture

### Struktur Folder Utama

```
app/Livewire/
├── Auth/                          # Authentication components
├── Features/                      # Feature-based components
│   ├── Admin/                    # Admin role components
│   ├── Peserta/                  # Peserta role components
│   └── Qualifier/                # Qualifier role components
└── GlobalLeaderboard.php         # Shared component
```

### Prinsip Organisasi

1. **Role-Based Separation**: Component dipisahkan berdasarkan role user
2. **Feature Grouping**: Component dalam role dikelompokkan berdasarkan fitur
3. **CRUD Pattern**: Setiap resource mengikuti pola Index, Create, Edit, View
4. **Naming Convention**: Menggunakan PascalCase dengan prefix fitur

## Components and Interfaces

### 1. Authentication Components (`Auth/`)

**Location**: `app/Livewire/Auth/`

| Component | Purpose | Route Pattern |
|-----------|---------|---------------|
| `Login.php` | Handle user login | `/login` |
| `Register.php` | Handle user registration | `/register` |
| `Logout.php` | Handle user logout | `/logout` |

**Responsibilities**:
- Form validation
- Authentication logic
- Session management
- Redirect after auth

---

### 2. Admin Components (`Features/Admin/`)

**Location**: `app/Livewire/Features/Admin/`

#### 2.1 Dashboard & Analytics

| Component | Purpose |
|-----------|---------|
| `Dashboard.php` | Admin dashboard overview |
| `Analytics.php` | System analytics and reports |

#### 2.2 Badge Management (`Badge/`)

**Location**: `app/Livewire/Features/Admin/Badge/`

| Component | Purpose | Route Pattern |
|-----------|---------|---------------|
| `BadgeIndex.php` | List all badges | `/admin/badges` |
| `BadgeCreate.php` | Create new badge | `/admin/badges/create` |
| `BadgeEdit.php` | Edit existing badge | `/admin/badges/{id}/edit` |
| `BadgeView.php` | View badge details | `/admin/badges/{id}` |

**Key Features**:
- Badge CRUD operations
- Badge condition management
- Icon/image upload
- Badge type categorization

#### 2.3 Category Management (`Category/`)

**Location**: `app/Livewire/Features/Admin/Category/`

| Component | Purpose | Route Pattern |
|-----------|---------|---------------|
| `CategoryIndex.php` | List all categories | `/admin/categories` |
| `CategoryCreate.php` | Create new category | `/admin/categories/create` |
| `CategoryEdit.php` | Edit existing category | `/admin/categories/{id}/edit` |
| `CategoryView.php` | View category details | `/admin/categories/{id}` |

**Key Features**:
- Category CRUD operations
- Question count per category
- Category description management

#### 2.4 Competition Management (`Competitions/`)

**Location**: `app/Livewire/Features/Admin/Competitions/`

| Component | Purpose | Route Pattern |
|-----------|---------|---------------|
| `CompetitionIndex.php` | List all competitions | `/admin/competitions` |
| `CompetitionCreate.php` | Create new competition | `/admin/competitions/create` |
| `CompetitionEdit.php` | Edit existing competition | `/admin/competitions/{id}/edit` |
| `CompetitionView.php` | View competition details | `/admin/competitions/{id}` |

**Key Features**:
- Competition CRUD operations
- Date range management
- Status management (draft, active, completed)
- Speed bonus configuration
- Penalty configuration
- Duration settings

#### 2.5 Question Management (`Question/`)

**Location**: `app/Livewire/Features/Admin/Question/`

| Component | Purpose | Route Pattern |
|-----------|---------|---------------|
| `QuestionIndex.php` | List all questions | `/admin/questions` |
| `QuestionCreate.php` | Create new question | `/admin/questions/create` |
| `QuestionEdit.php` | Edit existing question | `/admin/questions/{id}/edit` |
| `QuestionView.php` | View question details | `/admin/questions/{id}` |

**Key Features**:
- Question CRUD operations
- Multiple choice answers management
- Difficulty level assignment
- Point weight configuration
- Category assignment
- Validation status tracking

#### 2.6 Peserta Management (`ListPeserta/`)

**Location**: `app/Livewire/Features/Admin/ListPeserta/`

| Component | Purpose | Route Pattern |
|-----------|---------|---------------|
| `PesertaList.php` | List all peserta | `/admin/peserta` |
| `PesertaEdit.php` | Edit peserta data | `/admin/peserta/{id}/edit` |
| `PesertaShow.php` | View peserta details | `/admin/peserta/{id}` |

**Key Features**:
- View all participants
- Edit participant information
- View participation history
- Badge awards tracking

#### 2.7 Qualifier Management (`ListQualifier/`)

**Location**: `app/Livewire/Features/Admin/ListQualifier/`

| Component | Purpose | Route Pattern |
|-----------|---------|---------------|
| `QualifierList.php` | List all qualifiers | `/admin/qualifiers` |
| `QualifierCreate.php` | Create new qualifier | `/admin/qualifiers/create` |
| `QualifierEdit.php` | Edit qualifier data | `/admin/qualifiers/{id}/edit` |
| `QualifierShow.php` | View qualifier details | `/admin/qualifiers/{id}` |

**Key Features**:
- Qualifier user management
- Verification statistics
- Role assignment

---

### 3. Peserta Components (`Features/Peserta/`)

**Location**: `app/Livewire/Features/Peserta/`

#### 3.1 Dashboard

| Component | Purpose | Route Pattern |
|-----------|---------|---------------|
| `Dashboard.php` | Peserta dashboard | `/peserta/dashboard` |

**Key Features**:
- Available competitions
- Personal statistics
- Recent badges
- Leaderboard preview

#### 3.2 Badge Display

| Component | Purpose | Route Pattern |
|-----------|---------|---------------|
| `MyBadges.php` | Display user's badges | `/peserta/badges` |

**Key Features**:
- Display earned badges
- Badge details
- Achievement progress

#### 3.3 Competition Features (`Competitions/`)

**Location**: `app/Livewire/Features/Peserta/Competitions/`

| Component | Purpose | Route Pattern |
|-----------|---------|---------------|
| `CompetitionList.php` | List available competitions | `/peserta/competitions` |
| `CompetitionQuiz.php` | Take competition quiz | `/peserta/competitions/{id}/quiz` |
| `CompetitionResult.php` | View competition results | `/peserta/competitions/{id}/result` |

**Key Features**:
- Browse competitions
- Filter by status/date
- Start competition
- Answer questions with timer
- Real-time score calculation
- Submit answers
- View final results
- View correct answers
- Performance breakdown

---

### 4. Qualifier Components (`Features/Qualifier/`)

**Location**: `app/Livewire/Features/Qualifier/`

| Component | Purpose | Route Pattern |
|-----------|---------|---------------|
| `Dashboard.php` | Qualifier dashboard | `/qualifier/dashboard` |
| `AnswerValidation.php` | Validate participant answers | `/qualifier/validation` |

**Key Features**:
- Pending validations queue
- Question verification
- Answer verification
- Validation status update
- Verification history

---

### 5. Shared Components

**Location**: `app/Livewire/`

| Component | Purpose | Route Pattern |
|-----------|---------|---------------|
| `GlobalLeaderboard.php` | Display global leaderboard | `/leaderboard` |

**Key Features**:
- Display top performers
- Filter by competition
- Real-time ranking
- Score display

---

## Data Models

### Component Data Flow

```
User Authentication
    ↓
Role-Based Routing
    ↓
├── Admin → CRUD Operations → Database
├── Peserta → Competition Flow → Scoring → Leaderboard
└── Qualifier → Validation Flow → Database Update
```

### Common Component Properties

```php
// Typical Livewire Component Structure
class ComponentName extends Component
{
    // Public properties (reactive)
    public $model;
    public $form = [];
    
    // Validation rules
    protected $rules = [];
    
    // Lifecycle hooks
    public function mount() {}
    public function updated($propertyName) {}
    
    // Actions
    public function save() {}
    public function delete() {}
    
    // Render
    public function render() {}
}
```

## Error Handling

### Validation Patterns

1. **Form Validation**: Real-time validation using Livewire validation
2. **Authorization**: Middleware-based role checking
3. **Error Messages**: User-friendly error display
4. **Exception Handling**: Try-catch blocks for critical operations

### Common Error Scenarios

- Unauthorized access → Redirect to appropriate dashboard
- Validation errors → Display inline errors
- Database errors → Log and show generic error
- Not found → 404 page

## Testing Strategy

### Component Testing Approach

1. **Unit Tests**: Test individual component methods
2. **Feature Tests**: Test complete user flows
3. **Browser Tests**: Test UI interactions with Dusk

### Key Test Scenarios

- Authentication flow
- CRUD operations for each resource
- Competition participation flow
- Validation workflow
- Leaderboard calculation

---

## Component Naming Conventions

### Pattern: `{Feature}{Action}.php`

**Examples**:
- `BadgeIndex.php` - List badges
- `BadgeCreate.php` - Create badge form
- `BadgeEdit.php` - Edit badge form
- `BadgeView.php` - View badge details

### Route Naming Pattern

```
{role}.{feature}.{action}

Examples:
- admin.badges.index
- admin.badges.create
- peserta.competitions.quiz
- qualifier.validation
```

---

## Best Practices

1. **Single Responsibility**: Each component handles one specific feature
2. **Reusable Logic**: Extract common logic to traits or services
3. **Authorization**: Always check user permissions
4. **Validation**: Validate all user inputs
5. **Error Handling**: Provide clear error messages
6. **Performance**: Use lazy loading and pagination
7. **Security**: Sanitize inputs and outputs

---

## Adding New Components

### Steps to Add New Component

1. **Create Component Class**
   ```bash
   php artisan make:livewire Features/Admin/NewFeature/NewFeatureIndex
   ```

2. **Define Properties and Methods**
   ```php
   public $items;
   public function mount() { /* load data */ }
   ```

3. **Create Blade View**
   ```blade
   <div>
       <!-- Component UI -->
   </div>
   ```

4. **Add Route**
   ```php
   Route::get('/admin/new-feature', NewFeatureIndex::class)
       ->name('admin.new-feature.index');
   ```

5. **Add Navigation Link**
   ```blade
   <a href="{{ route('admin.new-feature.index') }}">New Feature</a>
   ```

---

## Summary

Struktur Livewire component di project ini mengikuti pola yang konsisten:

- **Role-based organization** untuk security dan clarity
- **Feature grouping** untuk maintainability
- **CRUD patterns** untuk consistency
- **Clear naming conventions** untuk readability

Setiap component memiliki tanggung jawab yang jelas dan mengikuti best practices Laravel Livewire.
