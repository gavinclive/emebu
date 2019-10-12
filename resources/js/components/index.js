import Vue from 'vue'
import Card from './Card'
import Child from './Child'
import Button from './Button'
import Checkbox from './Checkbox'
import EventCard from './EventCard'
import Ticket from './Ticket'
import { HasError, AlertError, AlertSuccess } from 'vform'

// Components that are registered globaly.
[
  Card,
  Child,
  Button,
  Checkbox,
  HasError,
  AlertError,
  AlertSuccess,
  EventCard,
  Ticket
].forEach(Component => {
  Vue.component(Component.name, Component)
})
