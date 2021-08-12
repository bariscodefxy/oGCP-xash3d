#include <amxmodx>
#include <fakemeta>
#include <engine>

new const PLUGINNAME[] = "Kar Yagdirma Eklentisi"
new const VERSION[] = "1.0"
new const AUTHOR[] = "XrouRamein"

new g_classstring[9]
public forward_setmodel(entity, model[]) {
	//server_print("forward_setmodel called in %s, entity: %d, model: %s", PLUGINNAME, entity, model)
	if (!is_valid_ent(entity))
		return FMRES_IGNORED

	entity_get_string(entity, EV_SZ_classname, g_classstring, 8)
	//server_print("^^Classname: %s", g_classstring)
	if (equal(g_classstring, "env_rain")) {
		//log_amx("Replaced rain with snow!")
		entity_set_string(entity, EV_SZ_classname, "env_snow")
	}

	return FMRES_IGNORED
}

public plugin_precache() {
	register_forward(FM_SetModel, "forward_setmodel")
        engfunc(EngFunc_CreateNamedEntity, engfunc(EngFunc_AllocString, "env_snow"));

	return PLUGIN_CONTINUE
}

public plugin_init() {
	register_plugin(PLUGINNAME, VERSION, AUTHOR)

	// Pause here. Models can't be changed after precache... because they're already... cached. I think. :-)
	pause("a")
}

public client_connect(id)
	client_cmd(id, "cl_weather 1");


stock fm_set_rendering() 
{

}
