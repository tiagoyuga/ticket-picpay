export const URL_BASE = '/api';

export function fromJson(model, object) {
    for (var name in model) {
        if (object.hasOwnProperty(name)) {
            model[name] = object[name]
        }
    }

    return model
}
