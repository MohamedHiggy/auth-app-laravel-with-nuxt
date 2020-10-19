export default function({ store, redirect }) {
    if (store.getters['user-auth/authenticated']) {
        return redirect('/');
    }
}