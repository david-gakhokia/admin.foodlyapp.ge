# Admin Reservations Module - Component Specifications

## 1. Status Chips Component

### Design Specifications
- **Size**: Small pill badges (24px height)
- **Border Radius**: Full rounded (9999px)
- **Padding**: Horizontal 8px, Vertical 4px
- **Font**: 12px, medium weight (500)
- **Border**: 1px solid matching status color

### Status Colors & States
```css
.status-chip-pending {
  background-color: #FEF3C7;
  color: #92400E;
  border-color: #F59E0B;
}
.status-chip-pending:hover {
  background-color: #FDE68A;
}

.status-chip-confirmed {
  background-color: #D1FAE5;
  color: #047857;
  border-color: #10B981;
}
.status-chip-confirmed:hover {
  background-color: #A7F3D0;
}

.status-chip-checked-in {
  background-color: #DBEAFE;
  color: #1E40AF;
  border-color: #3B82F6;
}
.status-chip-checked-in:hover {
  background-color: #BFDBFE;
}

.status-chip-canceled {
  background-color: #FEE2E2;
  color: #B91C1C;
  border-color: #EF4444;
}
.status-chip-canceled:hover {
  background-color: #FECACA;
}
```

### Georgian Labels
- Pending: "მოლოდინში"
- Confirmed: "დადასტურებული"
- Checked-in: "შემოვიდა"
- Canceled: "გაუქმებული"

### Accessibility
- `role="status"`
- `aria-label` with full status description
- Keyboard focusable when interactive

---

## 2. Table Row Component

### Structure & Hierarchy
```html
<tr class="table-row">
  <td class="col-id">
    <span class="id-badge">#123</span>
  </td>
  <td class="col-guest">
    <div class="guest-name">გიორგი ალექსიძე</div>
    <div class="guest-contact">+995551234567</div>
    <div class="guest-email">giorgi@example.com</div>
  </td>
  <td class="col-reservable">
    <div class="place-type">რესტორანი</div>
    <div class="place-name">თბილისი რესტორანი</div>
    <div class="table-info">მაგიდა #5</div>
  </td>
  <td class="col-datetime">
    <div class="date">2025-09-01</div>
    <div class="time">19:00 - 21:00</div>
  </td>
  <td class="col-guests">
    <span class="guests-count">4 სტუმარი</span>
  </td>
  <td class="col-status">
    <status-chip status="confirmed" />
  </td>
  <td class="col-actions">
    <action-buttons />
  </td>
</tr>
```

### Styling
```css
.table-row {
  border-bottom: 1px solid #E5E5E5;
  transition: background-color 0.15s ease;
  cursor: pointer;
}
.table-row:hover {
  background-color: #FAFAFA;
}

.guest-name {
  font-weight: 500;
  color: #171717;
  font-size: 14px;
}
.guest-contact, .guest-email {
  font-size: 12px;
  color: #737373;
  margin-top: 2px;
}

.place-type {
  font-weight: 500;
  color: #171717;
  font-size: 14px;
}
.place-name, .table-info {
  font-size: 12px;
  color: #737373;
  margin-top: 2px;
}

.date {
  font-weight: 500;
  color: #171717;
  font-size: 14px;
}
.time {
  font-size: 12px;
  color: #737373;
  margin-top: 2px;
}
```

---

## 3. Quick Reservation Modal

### Layout & Dimensions
- **Max Width**: 720px
- **Mobile**: Full width with 16px margins
- **Positioning**: Centered overlay
- **z-index**: 50

### Structure
```html
<div class="modal-overlay">
  <div class="modal-container">
    <header class="modal-header">
      <h3>ჯავშნის დეტალები #123</h3>
      <button class="close-button" aria-label="დახურვა">×</button>
    </header>
    
    <div class="modal-body">
      <!-- Scrollable content -->
    </div>
    
    <footer class="modal-footer">
      <button class="btn-primary">რედაქტირება</button>
      <button class="btn-secondary">დახურვა</button>
    </footer>
  </div>
</div>
```

### Modal States
1. **Loading**: Spinner with "იტვირთება..." text
2. **Error**: Error message with retry option
3. **Empty**: "ჯავშანი ვერ მოიძებნა" message
4. **Normal**: Full reservation details

### Responsive Behavior
- **Desktop**: 720px max-width, centered
- **Tablet**: 90% width, 32px margins
- **Mobile**: Full-screen overlay

---

## 4. Calendar Event Card

### Event Display
```html
<div class="calendar-event" data-status="confirmed">
  <div class="event-header">
    <span class="event-time">19:00</span>
    <span class="event-guests">4 სტუმარი</span>
  </div>
  <div class="event-title">ჯავშენი #123</div>
  <div class="event-restaurant">თბილისი რესტორანი</div>
</div>
```

### Status-based Styling
```css
.calendar-event[data-status="pending"] {
  background: linear-gradient(135deg, #FEF3C7 0%, #F59E0B 100%);
  border-left: 4px solid #F59E0B;
}

.calendar-event[data-status="confirmed"] {
  background: linear-gradient(135deg, #D1FAE5 0%, #10B981 100%);
  border-left: 4px solid #10B981;
}

.calendar-event[data-status="checked-in"] {
  background: linear-gradient(135deg, #DBEAFE 0%, #3B82F6 100%);
  border-left: 4px solid #3B82F6;
}

.calendar-event[data-status="canceled"] {
  background: linear-gradient(135deg, #FEE2E2 0%, #EF4444 100%);
  border-left: 4px solid #EF4444;
}
```

### Tooltip Content
```html
<div class="event-tooltip">
  <div class="tooltip-header">
    <strong>ჯავშენი #123</strong>
    <span class="status-chip">დადასტურებული</span>
  </div>
  <div class="tooltip-body">
    <p><strong>დრო:</strong> 19:00 - 21:00</p>
    <p><strong>სტუმრები:</strong> 4 ადამიანი</p>
    <p><strong>ტელეფონი:</strong> +995551234567</p>
    <p><strong>შენიშვნა:</strong> birthday, please prepare small cake</p>
  </div>
</div>
```

---

## 5. Action Buttons

### Button Specifications
```css
.action-button {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 6px 12px;
  border-radius: 6px;
  font-size: 14px;
  font-weight: 500;
  transition: all 0.15s ease;
  border: 1px solid #E5E5E5;
  background: white;
}

.action-button:hover {
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

.action-button-view {
  color: #3B82F6;
}
.action-button-view:hover {
  background: #EFF6FF;
  border-color: #3B82F6;
}

.action-button-edit {
  color: #7C3AED;
}
.action-button-edit:hover {
  background: #F3E8FF;
  border-color: #7C3AED;
}

.action-button-delete {
  color: #EF4444;
  border-color: #FEE2E2;
}
.action-button-delete:hover {
  background: #FEF2F2;
  border-color: #EF4444;
}
```

### Icon Specifications
- **Size**: 16px x 16px
- **Stroke Width**: 2px
- **Format**: SVG with currentColor fill

---

## 6. Filter Components

### Filter Section Layout
```css
.filters-section {
  background: white;
  border-radius: 12px;
  padding: 24px;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
  border: 1px solid #E5E5E5;
}

.filter-group {
  margin-bottom: 16px;
}

.filter-label {
  display: block;
  font-size: 14px;
  font-weight: 500;
  color: #374151;
  margin-bottom: 4px;
}

.filter-input {
  width: 100%;
  padding: 8px 12px;
  border: 1px solid #D1D5DB;
  border-radius: 6px;
  font-size: 14px;
  transition: border-color 0.15s ease;
}

.filter-input:focus {
  outline: none;
  border-color: #3B82F6;
  box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}
```

### Quick Status Filters
```css
.status-filter-chips {
  display: flex;
  gap: 8px;
  flex-wrap: wrap;
  margin-bottom: 16px;
}

.status-filter-chip {
  padding: 6px 12px;
  border-radius: 20px;
  font-size: 14px;
  font-weight: 500;
  border: 1px solid #D1D5DB;
  background: white;
  color: #374151;
  cursor: pointer;
  transition: all 0.15s ease;
}

.status-filter-chip.active {
  background: #3B82F6;
  color: white;
  border-color: #3B82F6;
}
```

---

## RTL (Right-to-Left) Considerations

### Text Direction
```css
.rtl-support {
  direction: rtl;
  text-align: right;
}

.rtl-support .action-buttons {
  flex-direction: row-reverse;
}

.rtl-support .status-chips {
  margin-left: 8px;
  margin-right: 0;
}
```

### Spacing Adjustments
- Use logical properties: `margin-inline-start` instead of `margin-left`
- Icon positions: `padding-inline-end` for trailing icons
- Text alignment: `text-align: start` instead of `text-align: left`
