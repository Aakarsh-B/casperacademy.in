// Runs in front of the static site (see wrangler.jsonc). Only one job: answer the old spam
// addresses such as /?p32378704399537/ with 410 Gone, so Google drops them. Real pages never use
// a bare query like that (tracking links use key=value, e.g. ?utm_source=…, ?fbclid=…).
const SPAM_QUERY = /^\?[a-z0-9]{8,}\/?$/i;

export default {
  async fetch(request, env) {
    const url = new URL(request.url);
    if (SPAM_QUERY.test(url.search)) {
      return new Response('Gone', {
        status: 410,
        headers: { 'content-type': 'text/plain; charset=utf-8', 'x-robots-tag': 'noindex' },
      });
    }
    return env.ASSETS.fetch(request);
  },
};
