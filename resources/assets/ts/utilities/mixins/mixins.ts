export default function (base: any, ...mixins: Array<any>) {
    mixins.forEach(mixin => {
        Object.getOwnPropertyNames(mixin.prototype).forEach(name => {
            base.prototype[name] = mixin.prototype[name];
        });
    });

    return base;
}
