# Admin Reservations Module - Interaction Specifications

## 1. Filter Behavior

### Real-time Filtering
```typescript
interface FilterState {
  dateFrom: string | null;
  dateTo: string | null;
  type: 'restaurant' | 'place' | 'table' | null;
  status: 'pending' | 'confirmed' | 'checked-in' | 'canceled' | null;
  restaurantId: number | null;
  searchQuery: string | null;
}

// Filter application strategy
const applyFilters = (filters: FilterState) => {
  // Debounce search input by 300ms
  if (filters.searchQuery) {
    debounce(performSearch, 300)(filters.searchQuery);
  }
  
  // Instant application for dropdowns/chips
  if (filters.status || filters.type || filters.restaurantId) {
    updateReservationsList(filters);
    updateCalendarEvents(filters);
  }
  
  // Date range validation
  if (filters.dateFrom && filters.dateTo) {
    if (new Date(filters.dateFrom) > new Date(filters.dateTo)) {
      showValidationError('დასაწყისი თარიღი უნდა იყოს დასასრულ თარიღზე ადრე');
      return;
    }
  }
};
```

### Status Chip Toggles
```typescript
const statusChipBehavior = {
  // Multiple status selection allowed
  multiSelect: true,
  
  // Click behavior
  onClick: (status: string) => {
    const currentFilters = getActiveFilters();
    const statusArray = currentFilters.status || [];
    
    if (statusArray.includes(status)) {
      // Remove if already selected
      removeStatusFilter(status);
    } else {
      // Add to selection
      addStatusFilter(status);
    }
    
    // Visual feedback
    updateChipAppearance();
    applyFilters();
  },
  
  // Clear all
  onClearAll: () => {
    clearAllStatusFilters();
    applyFilters();
  }
};
```

### Date Range Picker
```typescript
const dateRangeBehavior = {
  // Default to current month
  defaultRange: {
    from: startOfMonth(new Date()),
    to: endOfMonth(new Date())
  },
  
  // Quick presets
  presets: [
    { label: 'დღეს', value: 'today' },
    { label: 'ხვალ', value: 'tomorrow' },
    { label: 'ამ კვირაში', value: 'thisWeek' },
    { label: 'შემდეგ კვირაში', value: 'nextWeek' },
    { label: 'ამ თვეში', value: 'thisMonth' }
  ],
  
  // Validation
  validate: (from: Date, to: Date) => {
    if (from > to) return 'არასწორი თარიღების დიაპაზონი';
    if (differenceInDays(to, from) > 90) return 'მაქსიმუმ 90 დღე';
    return null;
  }
};
```

---

## 2. Calendar Event Interactions

### Event Click Flow
```typescript
interface CalendarEventClick {
  // Event data from FullCalendar
  event: {
    id: string;
    title: string;
    start: Date;
    end: Date;
    extendedProps: {
      status: string;
      guests_count: number;
      phone: string;
      restaurant_name: string;
      reservation_id: number;
    };
  };
}

const handleEventClick = (info: CalendarEventClick) => {
  const reservationId = info.event.extendedProps.reservation_id;
  const restaurantId = extractRestaurantId(info.event);
  
  // Prevent default calendar navigation
  info.jsEvent.preventDefault();
  
  // Open quick modal
  openQuickModal({
    reservationId,
    restaurantId,
    title: `ჯავშენი #${reservationId}`,
    modalType: 'view'
  });
  
  // Analytics tracking
  trackEvent('calendar_event_clicked', {
    reservation_id: reservationId,
    status: info.event.extendedProps.status
  });
};
```

### Event Tooltip
```typescript
const eventTooltipConfig = {
  // Show on hover after 500ms delay
  delay: 500,
  
  // Hide on mouse leave after 200ms
  hideDelay: 200,
  
  // Tooltip content
  generateContent: (event: CalendarEvent) => `
    <div class="event-tooltip">
      <div class="tooltip-header">
        <strong>${event.title}</strong>
        <span class="status-chip status-${event.extendedProps.status}">
          ${getStatusLabel(event.extendedProps.status)}
        </span>
      </div>
      <div class="tooltip-body">
        <p><strong>დრო:</strong> ${formatTime(event.start)} - ${formatTime(event.end)}</p>
        <p><strong>სტუმრები:</strong> ${event.extendedProps.guests_count} ადამიანი</p>
        <p><strong>ტელეფონი:</strong> ${event.extendedProps.phone}</p>
        ${event.extendedProps.note ? `<p><strong>შენიშვნა:</strong> ${event.extendedProps.note}</p>` : ''}
      </div>
      <div class="tooltip-footer">
        <small>დააწკაპუნეთ დეტალებისთვის</small>
      </div>
    </div>
  `,
  
  // Positioning
  position: 'top',
  arrow: true
};
```

### Calendar View Navigation
```typescript
const calendarNavigation = {
  // Default view
  initialView: 'dayGridMonth',
  
  // Available views
  views: ['dayGridMonth', 'timeGridWeek', 'timeGridDay'],
  
  // View change behavior
  onViewChange: (view: string) => {
    // Update URL parameter
    updateUrlParameter('view', view);
    
    // Adjust event loading strategy
    if (view === 'timeGridDay') {
      loadDetailedEvents();
    } else {
      loadSummaryEvents();
    }
    
    // Save user preference
    saveUserPreference('calendar_view', view);
  },
  
  // Date navigation
  onDateChange: (date: Date) => {
    // Update filters to match calendar date
    updateDateFilters({
      from: startOfMonth(date),
      to: endOfMonth(date)
    });
  }
};
```

---

## 3. Table Row Click Behavior

### Row Click Handler
```typescript
const handleRowClick = (event: MouseEvent, reservation: Reservation) => {
  // Ignore clicks on interactive elements
  const target = event.target as HTMLElement;
  const interactiveElements = ['A', 'BUTTON', 'INPUT', 'SELECT'];
  
  if (interactiveElements.includes(target.tagName) || 
      target.closest('a, button, input, select, form')) {
    return;
  }
  
  // Prevent text selection on double-click
  event.preventDefault();
  
  // Open quick modal instead of navigation
  openQuickModal({
    reservationId: reservation.id,
    restaurantId: reservation.restaurant_id,
    title: `ჯავშენი #${reservation.id}`,
    modalType: 'view'
  });
  
  // Visual feedback
  addRowHighlight(event.currentTarget);
  setTimeout(() => removeRowHighlight(event.currentTarget), 200);
};
```

### Keyboard Navigation
```typescript
const tableKeyboardNavigation = {
  // Make table rows focusable
  setup: () => {
    document.querySelectorAll('.reservation-row').forEach((row, index) => {
      row.setAttribute('tabindex', '0');
      row.setAttribute('role', 'button');
      row.setAttribute('aria-label', `ჯავშენი ${index + 1}, დააწკაპუნეთ დეტალებისთვის`);
    });
  },
  
  // Keyboard event handlers
  onKeyDown: (event: KeyboardEvent) => {
    const currentRow = event.currentTarget as HTMLTableRowElement;
    
    switch (event.key) {
      case 'Enter':
      case ' ':
        event.preventDefault();
        currentRow.click();
        break;
        
      case 'ArrowDown':
        event.preventDefault();
        focusNextRow(currentRow);
        break;
        
      case 'ArrowUp':
        event.preventDefault();
        focusPreviousRow(currentRow);
        break;
        
      case 'Home':
        event.preventDefault();
        focusFirstRow();
        break;
        
      case 'End':
        event.preventDefault();
        focusLastRow();
        break;
    }
  }
};
```

---

## 4. Modal Lifecycle Management

### Modal State Machine
```typescript
enum ModalState {
  CLOSED = 'closed',
  OPENING = 'opening',
  LOADING = 'loading',
  LOADED = 'loaded',
  ERROR = 'error',
  CLOSING = 'closing'
}

class QuickModalManager {
  private state: ModalState = ModalState.CLOSED;
  
  async openModal(config: ModalConfig) {
    if (this.state !== ModalState.CLOSED) {
      await this.closeModal();
    }
    
    this.setState(ModalState.OPENING);
    
    // Show modal container
    this.showModalOverlay();
    
    // Focus trap setup
    this.setupFocusTrap();
    
    // Load content
    this.setState(ModalState.LOADING);
    this.showLoadingState();
    
    try {
      const content = await this.fetchReservationData(config);
      this.setState(ModalState.LOADED);
      this.renderContent(content);
      this.setupEditButton(config);
    } catch (error) {
      this.setState(ModalState.ERROR);
      this.showErrorState(error);
    }
  }
  
  async closeModal() {
    this.setState(ModalState.CLOSING);
    
    // Clean up focus trap
    this.destroyFocusTrap();
    
    // Animate out
    await this.animateModalOut();
    
    // Hide modal
    this.hideModalOverlay();
    
    this.setState(ModalState.CLOSED);
  }
  
  private setupFocusTrap() {
    // Trap focus within modal
    const modal = document.getElementById('reservationQuickModal');
    const focusableElements = modal.querySelectorAll(
      'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])'
    );
    
    const firstElement = focusableElements[0] as HTMLElement;
    const lastElement = focusableElements[focusableElements.length - 1] as HTMLElement;
    
    modal.addEventListener('keydown', (e) => {
      if (e.key === 'Tab') {
        if (e.shiftKey && document.activeElement === firstElement) {
          e.preventDefault();
          lastElement.focus();
        } else if (!e.shiftKey && document.activeElement === lastElement) {
          e.preventDefault();
          firstElement.focus();
        }
      }
      
      if (e.key === 'Escape') {
        this.closeModal();
      }
    });
    
    // Focus first element
    firstElement?.focus();
  }
}
```

### Content Loading States
```typescript
const modalContentStates = {
  loading: () => `
    <div class="modal-loading">
      <div class="loading-spinner"></div>
      <p class="loading-text">იტვირთება...</p>
    </div>
  `,
  
  error: (error: Error) => `
    <div class="modal-error">
      <div class="error-icon">⚠️</div>
      <h4>შეცდომა ინფორმაციის ჩატვირთვისას</h4>
      <p>${error.message}</p>
      <button onclick="retryModalLoad()" class="btn-primary">
        თავიდან ცდა
      </button>
    </div>
  `,
  
  empty: () => `
    <div class="modal-empty">
      <div class="empty-icon">📝</div>
      <h4>ჯავშანი ვერ მოიძებნა</h4>
      <p>შესაძლოა ჯავშანი წაშლილია ან არ არსებობს</p>
    </div>
  `
};
```

---

## 5. Mobile Responsive Behavior

### Mobile Navigation
```typescript
const mobileNavigation = {
  // Filter drawer
  filterDrawer: {
    trigger: '.mobile-filter-button',
    
    open: () => {
      document.body.classList.add('drawer-open');
      document.getElementById('filterDrawer').classList.add('open');
      
      // Focus first filter input
      document.querySelector('.filter-input').focus();
    },
    
    close: () => {
      document.body.classList.remove('drawer-open');
      document.getElementById('filterDrawer').classList.remove('open');
    }
  },
  
  // Calendar toggle
  calendarToggle: {
    button: '.mobile-calendar-toggle',
    
    toggle: () => {
      const calendar = document.getElementById('calendar');
      const isVisible = calendar.classList.contains('mobile-visible');
      
      if (isVisible) {
        calendar.classList.remove('mobile-visible');
        // Scroll to reservations list
        document.getElementById('reservationsList').scrollIntoView({
          behavior: 'smooth'
        });
      } else {
        calendar.classList.add('mobile-visible');
        // Scroll to calendar
        calendar.scrollIntoView({ behavior: 'smooth' });
      }
    }
  }
};
```

### Touch Gestures
```typescript
const mobileGestures = {
  // Swipe to close modal
  modalSwipe: {
    threshold: 100, // px
    
    setup: (modalElement: HTMLElement) => {
      let startY = 0;
      
      modalElement.addEventListener('touchstart', (e) => {
        startY = e.touches[0].clientY;
      });
      
      modalElement.addEventListener('touchmove', (e) => {
        const currentY = e.touches[0].clientY;
        const deltaY = currentY - startY;
        
        if (deltaY > 0) {
          // Swipe down - apply transform
          modalElement.style.transform = `translateY(${Math.min(deltaY, 200)}px)`;
          modalElement.style.opacity = `${1 - (deltaY / 400)}`;
        }
      });
      
      modalElement.addEventListener('touchend', (e) => {
        const deltaY = e.changedTouches[0].clientY - startY;
        
        if (deltaY > this.threshold) {
          // Close modal
          modalManager.closeModal();
        } else {
          // Snap back
          modalElement.style.transform = '';
          modalElement.style.opacity = '';
        }
      });
    }
  },
  
  // Pull to refresh reservations list
  pullToRefresh: {
    threshold: 80,
    
    setup: (listContainer: HTMLElement) => {
      // Implementation similar to modal swipe
      // Shows refresh indicator and triggers data reload
    }
  }
};
```

---

## 6. Edit Navigation Flow

### Navigation Strategy
```typescript
const editNavigationFlow = {
  // From quick modal
  fromModal: (reservationId: number, restaurantId: number) => {
    const editUrl = `/admin/restaurants/${restaurantId}/reservations/${reservationId}/edit`;
    
    // Close modal first
    modalManager.closeModal();
    
    // Navigate with transition
    window.location.href = editUrl;
    
    // Alternative: Use AJAX navigation
    // navigateToEdit(editUrl);
  },
  
  // From table row action
  fromTableAction: (reservationId: number, restaurantId: number) => {
    const editUrl = `/admin/restaurants/${restaurantId}/reservations/${reservationId}/edit`;
    window.location.href = editUrl;
  },
  
  // Return navigation
  returnToList: () => {
    const listUrl = '/admin/reservations/list';
    const currentFilters = getActiveFilters();
    
    // Preserve filters in URL
    const urlWithFilters = `${listUrl}?${new URLSearchParams(currentFilters).toString()}`;
    
    window.location.href = urlWithFilters;
  }
};
```

### State Preservation
```typescript
const statePreservation = {
  // Save current view state before navigation
  saveState: () => {
    const state = {
      filters: getActiveFilters(),
      pagination: getCurrentPage(),
      sortOrder: getCurrentSortOrder(),
      calendarView: getCalendarView(),
      calendarDate: getCalendarDate()
    };
    
    sessionStorage.setItem('reservations_list_state', JSON.stringify(state));
  },
  
  // Restore state on return
  restoreState: () => {
    const savedState = sessionStorage.getItem('reservations_list_state');
    
    if (savedState) {
      const state = JSON.parse(savedState);
      
      // Restore filters
      applyFilters(state.filters);
      
      // Restore pagination
      goToPage(state.pagination);
      
      // Restore calendar
      setCalendarView(state.calendarView);
      setCalendarDate(state.calendarDate);
      
      // Clear saved state
      sessionStorage.removeItem('reservations_list_state');
    }
  }
};
```

---

## 7. Accessibility Features

### Screen Reader Support
```typescript
const accessibilityFeatures = {
  // ARIA live regions for dynamic content
  setupLiveRegions: () => {
    // Announce filter changes
    const filterStatus = document.createElement('div');
    filterStatus.setAttribute('aria-live', 'polite');
    filterStatus.setAttribute('aria-atomic', 'true');
    filterStatus.className = 'sr-only';
    filterStatus.id = 'filter-status';
    document.body.appendChild(filterStatus);
    
    // Announce modal state changes
    const modalStatus = document.createElement('div');
    modalStatus.setAttribute('aria-live', 'assertive');
    modalStatus.className = 'sr-only';
    modalStatus.id = 'modal-status';
    document.body.appendChild(modalStatus);
  },
  
  // Keyboard shortcuts
  keyboardShortcuts: {
    'Ctrl+F': () => focusSearchInput(),
    'Ctrl+N': () => openNewReservationModal(),
    'Escape': () => modalManager.closeModal(),
    'Alt+C': () => focusCalendar(),
    'Alt+L': () => focusReservationsList()
  },
  
  // Focus management
  focusManagement: {
    // Return focus after modal closes
    returnFocus: (originalElement: HTMLElement) => {
      originalElement.focus();
      
      // Announce to screen readers
      document.getElementById('modal-status').textContent = 
        'მოდალური ფანჯარა დაიხურა';
    }
  }
};
```

This comprehensive interaction specification ensures a smooth, accessible, and intuitive user experience across all devices and interaction patterns.
