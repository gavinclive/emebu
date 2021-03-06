function page (path) {
  return () => import(/* webpackChunkName: '' */ `~/pages/${path}`).then(m => m.default || m)
}

export default [
  { path: '/', name: 'welcome', component: page('welcome.vue') },

  { path: '/login', name: 'login', component: page('auth/login.vue') },
  { path: '/register', name: 'register', component: page('auth/register.vue') },
  { path: '/password/reset', name: 'password.request', component: page('auth/password/email.vue') },
  { path: '/password/reset/:token', name: 'password.reset', component: page('auth/password/reset.vue') },
  { path: '/email/verify/:id', name: 'verification.verify', component: page('auth/verification/verify.vue') },
  { path: '/email/resend', name: 'verification.resend', component: page('auth/verification/resend.vue') },

  { path: '/home', name: 'home', component: page('home.vue') },
  { path: '/event/input', name: 'event.input', component: page('event/event-input.vue') },
  { path: '/event/:id/edit', name: 'event.edit', component: page('event/event-input.vue') },
  { path: '/event', name: 'event.view', component: page('event/event-list.vue') },
  { path: '/history', name: 'transaction.history', component: page('transaction/transaction-list.vue') },
  { path: '/event/:id', name: 'event.detail', component: page('event/event-detail.vue') },
  { path: '/transaction', name: 'transaction.view', component: page('transaction/transaction-list.vue') },
  { path: '/transaction/:id', name: 'transaction.detail', component: page('transaction/transaction-detail.vue') },
  { path: '/checkout/:id', name: 'checkout', component: page('payment/checkout.vue') },
  { path: '/checkout/post/:id', name: 'post.checkout', component: page('payment/post-checkout.vue') },
  { path: '/faq', name: 'faq', component: page('faq.vue') },
  { path: '/download', name: 'download', component: page('download.vue') },

  { path: '/settings',
    component: page('settings/index.vue'),
    children: [
      { path: '', redirect: { name: 'settings.profile' } },
      { path: 'profile', name: 'settings.profile', component: page('settings/profile.vue') },
      { path: 'password', name: 'settings.password', component: page('settings/password.vue') },
      { path: 'atm', name: 'settings.atm', component: page('settings/atm.vue') }
    ]
  },

  { path: '/admin/users', name: 'users.admin', component: page('admin/user-list.vue') },
  { path: '/admin/events', name: 'events.admin', component: page('event/event-list.vue') },
  { path: '/admin/content', name: 'content.admin', component: page('admin/content-input.vue') },
  { path: '/admin/report', name: 'report.view', component: page('admin/report-list.vue') },

  { path: '/m',
    component: page('m/index.vue'),
    children: [
      { path: '', redirect: { name: 'm.login' } },
      { path: 'login', name: 'm.login', component: page('m/auth/login.vue') },
      { path: 'register', name: 'm.register', component: page('m/auth/register.vue') },
      { path: 'password/reset', name: 'm.password.request', component: page('m/auth/password/email.vue') },
      { path: 'settings', name: 'm.settings.index', component: page('m/settings/index.vue') },
      { path: 'settings/profile', name: 'm.settings.profile', component: page('settings/profile.vue') },
      { path: 'settings/password', name: 'm.settings.password', component: page('settings/password.vue') },
      { path: 'settings/atm', name: 'm.settings.atm', component: page('settings/atm.vue') },
      { path: 'event/input', name: 'm.event.input', component: page('m/event/event-input.vue') },
      { path: 'event/:id/edit', name: 'm.event.edit', component: page('m/event/event-input.vue') },
      { path: 'camera', name: 'camera', component: page('m/camera.vue') }
    ]
  },
  { path: '*', name: '404', component: page('errors/404.vue') }
]
