<template>
  <div class="custom-select" :data-name="name">
    <input class="custom-select__input" :name="name" @focus="onFocus" @blur="onBlur" readonly
           :placeholder="placeholder" :value="text" :disabled="disabled">
    <div class="custom-select__dropdown" :data-name="name">
      <div class="custom-select__option" @mousedown="onMousedown(o.value, o.text)" v-for="o in options" :data-value="o.value">
        {{ o.text }}
      </div>
    </div>
  </div>
</template>

<script>
import {createPopper} from '@popperjs/core';

export default {
  name: "CustomSelect",
  data() {
    return {
      value: '',
      text: '',
      popper: null,
      customSelect: null,
      dropdown: null,
    }
  },
  props: {
    placeholder: String,
    options: Array,
    name: String,
    disabled: {type: Boolean, default: false}
  },
  methods: {
    onFocus() {
      if (!this.disabled) {
        this.dropdown.setAttribute('data-show', '')
        this.popper.update();
      }
    },
    onBlur() {
      this.dropdown.removeAttribute('data-show');
    },
    onMousedown(value, text) {
      this.value = value;
      this.text = text;
      this.$emit('input', this.value)
    }
  },
  mounted() {
    this.customSelect = document.querySelector(`.custom-select[data-name=${this.name}]`);
    this.dropdown = document.querySelector(`.custom-select__dropdown[data-name=${this.name}]`);

    this.popper = createPopper(this.customSelect, this.dropdown, {
      placement: 'bottom',
      modifiers: [{
        name: "sameWidth",
        enabled: true,
        phase: "beforeWrite",
        requires: ["computeStyles"],
        fn: ({ state }) => {
          state.styles.popper.width = `${state.rects.reference.width}px`;
        },
        effect: ({ state }) => {
          state.elements.popper.style.width = `${
              state.elements.reference.offsetWidth
          }px`;
        }
      }]
    });
  },
}
</script>

<style>
.custom-select {
  position: relative;
}

.custom-select__input {
  line-height: 1.5;
  padding: 6px 16px;

  text-align: left;
  width: 100%;
  color: #FFFFFF;
  border-radius: 3px;
  background-color: transparent;
  outline: none;
  border: 2px solid #FFFFFF;
}

.custom-select__input:disabled {
  border: 2px solid #829db9;
  color: #829db9;
}

.custom-select__input:disabled::placeholder {
  color: #829db9;
}

.custom-select__input:disabled:hover {
  cursor: not-allowed;
}

.custom-select__input::placeholder {
  color: #FFFFFF;
}

.custom-select__input:hover {
  cursor: pointer;
}

.custom-select__dropdown {
  position: absolute;
  max-height: 300px;
  display: none;
  overflow-y: scroll;

  background-color: #FFFFFF;
  border: 1px solid #B7BCC1;
}

.custom-select__dropdown[data-show] {
  display: block;
}

.custom-select__option {
  padding-left: 7px;
  font-weight: 600;
  font-size: 13px;
  line-height: 40px;
  text-align: left;
}

.custom-select__option:hover {
  background-color: #0068DA;
  color: #FFFFFF;
  cursor: pointer;
}
</style>